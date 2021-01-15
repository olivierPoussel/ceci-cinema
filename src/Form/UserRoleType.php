<?php

namespace App\Form;

use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class UserRoleType extends UserType 
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);
        $data = [
            'ROLE_USER'=>'ROLE_USER', 
            'ROLE_ADMIN' => 'ROLE_ADMIN',
        ];
        $builder
            ->add('roles', ChoiceType::class, [
                'choices' => $data,
                // 'data' => $data,
                'multiple'=> true,
                'expanded' => true,
            ])
        ;
        // $builder->get("roles")->addModelTransformer(new CallbackTransformer(
        //     function ($data)
        //     {
        //         return implode(',',$data);
        //     },
        //     function ($data)
        //     {
        //         return $data;
        //     }
        // ));
    }
}