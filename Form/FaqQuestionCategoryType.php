<?php

namespace Tms\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Tms\Bundle\FaqBundle\Exception\MissingRelatedEntityException;

class FaqQuestionCategoryType extends QuestionCategoryType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $faq = $builder->getData()->getFaq();
        if(!$faq) {
            throw new MissingRelatedEntityException('Faq', $this);
        }

        parent::buildForm($builder, $options);
        $builder
            ->remove('faq')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tms_bundle_faqbundle_faqquestioncategorytype';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
