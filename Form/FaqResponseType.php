<?php

namespace Tms\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Tms\Bundle\FaqBundle\Exception\MissingRelatedEntityException;

class FaqResponseType extends ResponseType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $faq = $builder->getData()->getQuestion()->getFaq();
        if(!$faq) {
            throw new MissingRelatedEntityException('Faq', $this);
        }
        parent::buildForm($builder, $options);
        $builder->add('question', 'entity', array(
            'class' => 'Tms\Bundle\FaqBundle\Entity\Question',
            'property' => 'content',
            'query_builder' => function(\Doctrine\ORM\EntityRepository $er) use ($faq) {
                return $er->createQueryBuilder('q')
                    ->leftJoin('q.responses', 'r')
                    ->where('q.faq = :faq_id')
                    ->setParameter('faq_id', $faq->getId());
            }
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tms_bundle_faqbundle_faqresponsetype';
    }
}
