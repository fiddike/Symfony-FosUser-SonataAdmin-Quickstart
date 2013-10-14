<?php

namespace Phprogress\FormDemoBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DemoClassType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('demoString')
            ->add('demoText')
            ->add('demoFloat')
            ->add('demoEmail')
            ->add('demoDate')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Phprogress\FormDemoBundle\Entity\DemoClass'
        ));
    }

    public function getName()
    {
        return 'phprogress_formdemobundle_democlasstype';
    }
}
