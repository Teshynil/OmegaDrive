<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $timezones=[''=>''];
        foreach (timezone_identifiers_list() as $value) {
            $timezones[$value]=$value;
        }
        $builder->add('username', TextType::class)
                ->add('email', EmailType::class)
                ->add('password', RepeatedType::class,[
                    'type'            => PasswordType::class,
                    'invalid_message' => 'Las contraseñas deben coincidir.',
                    'first_name'      => 'password',
                    'second_name'     => 'confirm_password',
                    'required'        => true,
                ])
                ->add('timezone', ChoiceType::class,[
                    'mapped'=>false,
                    'label'=>'Zona horaria',
                    'choices'=>$timezones
                ])
                ->add('submit', SubmitType::class,['label' => 'Registrate']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }


}
