<?php

namespace Tms\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type as Types;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Tms\Bundle\FaqBundle\Manager\FaqManager;

class FaqType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $object = $options['object'];

        $builder
            ->add('title')
            ->add('enabled', Types\CheckboxType::class, array('required' => false))
            ->add('objectClassName', Types\HiddenType::class, array(
                'data' => $options['manager']->getClassName($object)
            ))
            ->add('objectId', Types\HiddenType::class, array(
                'data' => $object->getId()
            ))
            ->add('hash', Types\HiddenType::class, array(
                'data' => $options['manager']->generateHash($object)
            ))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver
            ->setDefaults(array(
                'data_class' => 'Tms\Bundle\FaqBundle\Entity\Faq',
            ))
            ->setRequired(array('object', 'manager'))
            ->setAllowedTypes('object', 'Tms\Bundle\FaqBundle\FaqOwnerInterface')
            ->setAllowedTypes('manager', 'Tms\Bundle\FaqBundle\Manager\FaqManager')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $this->configureOptions($resolver);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tms_bundle_faqbundle_faqtype';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
