<?php

namespace Tms\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Tms\Bundle\FaqBundle\Manager\FaqManager;

class FaqType extends AbstractType
{
    protected $faqManager;

    /**
     * Constructor
     *
     * @param FaqManager $faqManager
     */
    public function __construct(FaqManager $faqManager)
    {
        $this->faqManager = $faqManager;
    }

    /**
     * Get faq manager
     *
     * @return FaqManager
     */
    public function getFaqManager()
    {
        return $this->faqManager;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $object = $options['object'];

        $builder
            ->add('title')
            ->add('enabled', 'checkbox', array('required' => false))
            ->add('objectClassName', 'hidden', array(
                'data' => $this->getFaqManager()->getClassName($object)
            ))
            ->add('objectId', 'hidden', array(
                'data' => $object->getId()
            ))
            ->add('hash', 'hidden', array(
                'data' => $this->getFaqManager()->generateHash($object)
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => 'Tms\Bundle\FaqBundle\Entity\Faq',
            ))
            ->setRequired(array('object'))
            ->setAllowedTypes(array('object' => 'Tms\Bundle\FaqBundle\FaqOwnerInterface'))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tms_bundle_faqbundle_faqtype';
    }
}
