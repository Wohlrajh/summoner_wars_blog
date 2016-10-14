<?php

namespace Summoner\UserBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use FOS\UserBundle\Form\Type\ProfileFormType as ProfileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\LessThan;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfileFormType extends ProfileType
{

    /**
     * @var string
     */
    private $class;

    /**
     * @param string $class The User class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $child = $builder->create('user', FormType::class, array('data_class' => $this->class));
        $this->buildUserForm($child, $options);

        $builder
            ->add(
                'civility',
                CivilityType::class,
                array(
                    'label' => 'Civility'
                )
            )
            ->add(
                'lastName',
                LastNameType::class,
                array(
                    'label' => 'Lastname'
                )
            )
            ->add(
                'firstName',
                FirstNameType::class,
                array(
                    'label' => 'Firstname'
                )
            )
            ->add(
                'dateOfBirth',
                DateType::class,
                array(
                    'label' => 'Date of birth',
                    'years' => range(date('Y', strtotime('-12 years')), 1900),
                    'input' => 'datetime',
                    'constraints' => array(
                        new NotBlank(array('message' => 'This field is required.')),
                        new LessThan(
                            array(
                                'value' => '-12 years',
                                'message' => 'You must be at least 12 years old to be a member of Works.'
                            )
                        ),
                        new GreaterThanOrEqual(
                            array(
                                'value' => '01-01-1900',
                                'message' => 'Invalid date.'
                            )
                        ),
                    ),
                    'html5' => false,
                    /** @Ignore */
                    'empty_value' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day'),
                    'format' => 'MM dd yyyy',
                )
            )
            ->add(
                'address1',
                TextType::class,
                array(
                    'label' => 'Address 1',
                    'required' => true,
                    'constraints' => new NotBlank(array('message' => 'This field is required.'))
                )
            )
            ->add(
                'address2',
                TextType::class,
                array(
                    'label' => 'Address 2',
                )
            )
            ->add(
                'postalCode',
                TextType::class,
                array(
                    'label' => 'Postal code',
                    'required' => true,
                    'constraints' => array(
                        new NotBlank(
                            array(
                                'message' => 'This field is required.'
                            )
                        ),
                        new Length(
                            array(
                                'min' => 4,
                                'max' => 5,
                                'minMessage' => 'Your name must be at least {{ limit }} characters',
                                'maxMessage' => 'Your name can not be longer than {{ limit }} characters.',
                            )
                        )
                    ),
                )
            )
            ->add(
                'city',
                ChoiceType::class,
                array(
                    'label' => 'City',
                    'required' => true,
                    'constraints' => new NotBlank(array('message' => 'This field is required.')),
                )
            );

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $data = $event->getData();
            $form = $event->getForm();
            if (!is_null($data) && !is_null($data->getCity())) {
                $form->remove('city');
                $form->add(
                    'city',
                    ChoiceType::class,
                    array(
                        'label' => 'City',
                        'required' => true,
                        'constraints' => new NotBlank(array('message' => 'This field is required.')),
                        'choices' => array($data->getCity() => $data->getCity())
                    )
                );
            }
        });

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function(FormEvent $event) {
            $form = $event->getForm();
            $data = $event->getData();
            if (!is_null($data['city']) && !empty($data['city'])) {
                $form->remove('city');
                $form->add(
                    'city',
                    ChoiceType::class,
                    array(
                        'label' => 'City',
                        'required' => true,
                        'constraints' => new NotBlank(array('message' => 'This field is required.')),
                        'choices' => array($data['city'] => $data['city'])
                    )
                );
            }

        });

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Summoner\UserBundle\Entity\User',
            'attr' => array('novalidate' => 'novalidate'),
        ));
    }

    public function getName()
    {
        return 'summoner_profile_type';
    }
}
