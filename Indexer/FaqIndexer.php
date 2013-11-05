<?php

namespace Tms\Bundle\FaqBundle\Indexer;

use EWZ\Bundle\SearchBundle\Lucene\Document;
use EWZ\Bundle\SearchBundle\Lucene\Field;
use Zend\Search\Lucene\Search\QueryParser;
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

        $document->addField(Field::unIndexed('key', $entity->getId()));
        //$document->addField(Field::text('object','faq'));
        //$document->addField(Field::unStored('content', StringTools::transformSpecialChars($entity->getContent()), 'utf-8'));
        //$document->addField(Field::text('content', StringTools::transformSpecialChars($entity->getContent()), 'utf-8'));

        $mergedMessages = '';
        foreach ($entity->getResponses() as $response) {
            $mergedMessages .= $response->getMessage();
        }
        //$document->addField(Field::unStored('message', StringTools::transformSpecialChars($mergedMessages), 'utf-8'));

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
        //$userQuery = QueryParser::parse($cleanQuery);

        return parent::search('tags: '.$cleanQuery);
    }
}
