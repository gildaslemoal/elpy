<?php

namespace Elpy\Bundle\GeneralBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class KnowledgeTypeType extends AbstractType
{

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Elpy\Bundle\GeneralBundle\Entity\KnowledgeType'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'elpy_bundle_generalbundle_knowledgetype';
    }
}
