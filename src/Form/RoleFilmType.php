<?php

namespace App\Form;

use Symfony\Component\Form\FormBuilderInterface;

class RoleFilmType extends RoleType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $builder
            ->remove('film')
        ;
    }
}