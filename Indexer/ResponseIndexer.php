<?php

namespace Tms\Bundle\FaqBundle\Indexer;

use EWZ\Bundle\SearchBundle\Lucene\Document;
use EWZ\Bundle\SearchBundle\Lucene\Field;
use Tms\Bundle\FaqBundle\Tools\StringTools;
use Tms\Bundle\FaqBundle\Entity\Question;
use Tms\Bundle\FaqBundle\Entity\Response;
use Tms\Bundle\FaqBundle\Exception\InvalidIndexableEntityException;

class ResponseIndexer extends AbstractIndexer
{
    /**
     * {@inheritdoc}
     */
    public function index($entity, Document $document)
    {
        if(!$entity instanceof Response) {
            throw new InvalidIndexableEntityException($entity);
        }

        $document->addField(Field::keyword('key', $entity->getId()));
        $document->addField(Field::text('message', StringTools::deleteAccent($entity->getMessage()), 'utf-8'));
        $document->addField(Field::text('average', StringTools::deleteAccent($entity->getAverage()), 'utf-8'));
    }
}