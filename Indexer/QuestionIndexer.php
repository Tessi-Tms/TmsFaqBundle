<?php

namespace Tms\Bundle\FaqBundle\Indexer;

use EWZ\Bundle\SearchBundle\Lucene\Document;
use EWZ\Bundle\SearchBundle\Lucene\Field;
use Tms\Bundle\FaqBundle\Tools\StringTools;
use Tms\Bundle\FaqBundle\Entity\Question;
use Tms\Bundle\FaqBundle\Entity\Response;
use Tms\Bundle\FaqBundle\Exception\InvalidIndexableEntityException;

class QuestionIndexer extends AbstractIndexer
{
    /**
     * {@inheritdoc}
     */
    public function index($entity, Document $document)
    {
        if(!$entity instanceof Question) {
            throw new InvalidIndexableEntityException($entity);
        }

        $document->addField(Field::keyword('key', $entity->getId()));
        $document->addField(Field::text('content', StringTools::deleteAccent($entity->getContent()), 'utf-8'));
        
        $responses = $entity->getResponses();
        if(!is_null($responses)){
            foreach($responses as $response)
            {
                $document->addField(Field::keyword('responseId', $response->getId()));
                $document->addField(Field::keyword('message', $response->getMessage()));
            }
        }
    }
}
