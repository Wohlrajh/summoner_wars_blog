<?php

namespace Summoner\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class CivilityType extends AbstractType
{

    public function getParent()
    {
        return ChoiceType::class;
    }

    public function getName()
    {
        return 'civility';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'choices' => array(
                   'Mr' => 'Mr',
                   'Mrs' => 'Mrs',
                   'Ms' => 'Ms',
                   'Miss' => 'Miss'
                ),
                'constraints' => $this->getConstraints()
            )
        );
    }

    public function getConstraints()
    {
        return array(
            new NotBlank(array('message' => 'This field is required.'))
        );
    }
}
