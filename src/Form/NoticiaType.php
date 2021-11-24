<?php

namespace App\Form;

use App\Entity\Noticia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NoticiaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titular')
            ->add('entradilla')
            ->add('cuerpo')
            ->add('imagen')
            ->add('fecha')
            ->add('usuario')
            ->add('categoria');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Noticia::class,
        ]);
    }
}
