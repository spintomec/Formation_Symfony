<?php

namespace App\Form;

use App\Entity\Paysages;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;


class PaysageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image (JPG or PNG file)',
                'required' => false,
                'allow_delete' => true,
                'download_uri' => false,
                'imagine_pattern' => 'medium'
            ])
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Paysages::class,
        ]);
    }
}
