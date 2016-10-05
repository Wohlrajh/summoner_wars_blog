<?php

namespace Summoner\UserBundle\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use FOS\UserBundle\Form\Type\ProfileFormType as ProfileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
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
                TextType::class,
                array(
                    'label' => 'Civility',
                    'required' => true,
                    'constraints' => new NotBlank(array('message' => 'This field is required.'))
                )
            )
            ->add(
                'lastName',
                TextType::class,
                array(
                    'label' => 'Lastname',
                    'required' => true,
                    'constraints' => new NotBlank(array('message' => 'This field is required.'))
                )
            )
            ->add(
                'firstName',
                TextType::class,
                array(
                    'label' => 'Firstname',
                    'required' => true,
                    'constraints' => new NotBlank(array('message' => 'This field is required.'))
                )
            )
            /*->add(
                'dateOfBirth',
                TextType::class,
                array(
                    'label' => 'date Of Birth',
                    'required' => true,
                    'constraints' => new NotBlank(array('message' => 'This field is required.'))
                )
            )*/
            ->add(
                'zipCode',
                TextType::class,
                array(
                    'label' => 'Postal code',
                    'required' => true,
                    'constraints' => new NotBlank(array('message' => 'This field is required.'))
                )
            )
            ->add(
                'country',
                TextType::class,
                array(
                    'label' => 'Country',
                    'required' => true,
                    'constraints' => new NotBlank(array('message' => 'This field is required.'))
                )
            )
            ->add(
                'address1',
                TextType::class,
                array(
                    'label' => 'Adresse 1',
                    'required' => true,
                    'constraints' => new NotBlank(array('message' => 'This field is required.'))
                )
            )
            ->add(
                'address2',
                TextType::class,
                array(
                    'label' => 'Adresse 2',
                )
            )
            ->add(
                'city',
                TextType::class,
                array(
                    'label' => 'City',
                    'required' => true,
                    'constraints' => new NotBlank(array('message' => 'This field is required.'))
                )
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Summoner\UserBundle\Entity\User',
        ));
    }

    public function getName()
    {
        return 'summoner_profile_type';
    }
}
