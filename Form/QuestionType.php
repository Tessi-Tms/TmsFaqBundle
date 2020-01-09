<?php

namespace Tms\Bundle\FaqBundle\Form;

use IDCI\Bundle\SimpleMetadataBundle\Form\Type\RelatedToManyMetadataType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Tms\Bundle\MediaClientBundle\Form\Type\RelatedToOneMediaType;
use Tms\Bundle\WebAdminTemplateBundle\Form\Type\WysiwygTextareaType;

class QuestionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('question', WysiwygTextareaType::class)
            ->add('answer', WysiwygTextareaType::class)
            ->add('categories')
            ->add('tags', RelatedToManyMetadataType::class)
            ->add('faq')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tms\Bundle\FaqBundle\Entity\Question'
        ));
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
        return 'tms_bundle_faqbundle_questiontype';
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
