<?php

namespace Summoner\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;

class FirstNameType extends AbstractType
{

    public function getParent()
    {
        return TextType::class;
    }

    public function getBlockPrefix()
    {
        return 'firstName';
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array('constraints' => $this->getConstraints())
        );
    }

    public function getConstraints()
    {
        return array(
                new NotBlank(array('message' => 'This field is required.')),
                new Length(
                    array(
                        'min' => 2,
                        'max' => 50,
                        'minMessage' => 'Your name must be at least {{ limit }} characters',
                        'maxMessage' => 'Your name can not be longer than {{ limit }} characters.',
                    )
                ),
                new Regex(
                    array(
                        'pattern' => '/^[a-zA-ZÀ-ÿ\s\'-]{1,}$/',
                        'message' => 'Invalid first name'
                    )
                )
        );
    }
}
