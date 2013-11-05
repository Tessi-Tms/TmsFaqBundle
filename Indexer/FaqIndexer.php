<?php

namespace Tms\Bundle\FaqBundle\Indexer;

use EWZ\Bundle\SearchBundle\Lucene\Document;
use EWZ\Bundle\SearchBundle\Lucene\Field;
/*
use Zend\Search\Lucene\Index\Term;
use Zend\Search\Lucene\Search\Query\Fuzzy as FuzzyQuery;
use Zend\Search\Lucene\Search\Query\Term as TermQuery;
use Zend\Search\Lucene\Search\Query\MultiTerm as MultiTermQuery;
*/
use Tms\Bundle\FaqBundle\Tools\StringTools;
use Tms\Bundle\FaqBundle\Entity\Question;
use Tms\Bundle\FaqBundle\Entity\Response;
use Tms\Bundle\FaqBundle\Exception\InvalidIndexableEntityException;

class FaqIndexer extends AbstractIndexer
{
    /**
     * {@inheritdoc}
     */
    public function index($entity, Document $document)
    {
        if (!$entity instanceof Question) {
            throw new InvalidIndexableEntityException($entity);
        }

        $document->addField(Field::keyword('key', $entity->getId()));
        //$document->addField(Field::text('object','faq'));
        $document->addField(Field::text('content', StringTools::transformSpecialChars($entity->getContent()), 'utf-8'));

        $mergedMessages = '';
        foreach ($entity->getResponses() as $response) {
            $mergedMessages .= $response->getMessage();
        }
        $document->addField(Field::text('message', StringTools::transformSpecialChars($mergedMessages), 'utf-8'));

        $tagValues = '';
        foreach ($entity->getTags() as $tag) {
            $tagValues .= $tag->getValue().' ';
        }
        $document->addField(Field::text('tags', StringTools::transformSpecialChars($tagValues), 'utf-8'));
    }

    /**
     * {@inheritdoc}
     */
    public function search($query)
    {
        $cleanQuery = StringTools::transformSpecialChars($query);

        return parent::search('tags:'. $cleanQuery);
    }
}
