<?php

namespace Pousada\ElcapitanBundle\Form;

use Symfony\Component\Form\AbstractType; //base fields type
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PublicationType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name');
            /*, 'entity', array(
					'label' => 'Nom',
					'class' => 'PousadaElcapitanBundle:Publication'))
        ;*/
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Pousada\ElcapitanBundle\Entity\Publication'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'pousada_elcapitanbundle_publication';
    }
}
