<?php

namespace App\Form\Admin;

use App\Entity\WorkCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class CompletedWorkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Заголовок'
            ])
            ->add('description', CKEditorType::class, [
                'label' => 'Описание'
            ])
            ->add('gallery', CollectionType::class, [
                'label' => 'Галерея',
                'entry_type' => GalleryType::class,
                'allow_add' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => WorkCategory::class,
        ]);
    }
}
