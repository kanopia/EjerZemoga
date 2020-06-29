<?php
declare(strict_types=1);

namespace App\Form;

use App\Entity\User\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', VichFileType::class, [
                'label' => 'Picture Profile',
                'required' => false,
                'allow_delete' => false,
                'attr' => [
                    'class' => 'w-100'
                ]
            ])
            ->add('name', TextType::class, [
                'label' => 'Name',
                'required' => true,
                'attr' => [
                    'class' => 'w-100'
                ]
            ])
            ->add('title', TextType::class, [
                'label' => 'Title',
                'required' => true,
                'attr' => [
                    'class' => 'w-100'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description',
                'required' => true,
                'attr' => [
                    'class' => 'w-100',
                    'rows' => 5
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
