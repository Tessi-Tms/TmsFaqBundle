<?php

namespace Tms\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Tms\Bundle\FaqBundle\Exception\MissingRelatedEntityException;

class FaqQuestionResponseType extends ResponseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $question = $builder->getData()->getQuestion();
        if(!$question) {
            throw new MissingRelatedEntityException('Question', $this);
        }
        parent::buildForm($builder, $options);
        $builder
            ->remove('question')
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tms_bundle_faqbundle_faqquestionresponsetype';
    }
}
