<?php

namespace Tipddy\UPVBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class InscripcionType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
        ;
    }

    public function getName()
    {
        return 'tipddy_upvbundle_inscripciontype';
    }
}
