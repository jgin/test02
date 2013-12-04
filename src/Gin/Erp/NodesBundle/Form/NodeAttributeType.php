<?php

namespace Gin\Erp\NodesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NodeAttributeType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('node')
            ->add('name')
            ->add('caption')
            ->add('nodeType')
            ->add('nativeType')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Gin\Erp\NodesBundle\Entity\NodeAttribute'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gin_erp_nodesbundle_nodeattribute';
    }
}
