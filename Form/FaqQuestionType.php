<?php

namespace Tms\Bundle\FaqBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;
use Tms\Bundle\FaqBundle\Exception\MissingRelatedEntityException;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class FaqQuestionType extends QuestionType
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
            ->add('categories', EntityType::class, array(
                'multiple' => true,
                'expanded' => true,
                'class' => 'TmsFaqBundle:QuestionCategory',
                'query_builder' => function(EntityRepository $er) use ($faq) {
                    return $er->createQueryBuilder('qc')
                        ->where('qc.faq = :faq')
                        ->setParameter('faq', $faq)
                        ->orderBy('qc.name', 'ASC')
                    ;
                },
            ))
            ->remove('faq')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'tms_bundle_faqbundle_faqquestiontype';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
