<?php

namespace Tms\Bundle\FaqBundle\Indexer;

use EWZ\Bundle\SearchBundle\Lucene\Document;
use EWZ\Bundle\SearchBundle\Lucene\Field;
use Zend\Search\Lucene\Search\QueryParser;
use Tms\Bundle\FaqBundle\Entity\Question;
use Tms\Bundle\FaqBundle\Entity\Response;
use Tms\Bundle\FaqBundle\Tools\StringTools;

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
        $document->addField(Field::unStored('object', 'faq'));
        $document->addField(Field::unStored('content', StringTools::transformSpecialChars($entity->getContent()), 'utf-8'));

        /*
        $mergedMessages = '';
        foreach ($entity->getResponses() as $response) {
            $mergedMessages .= $response->getMessage();
        }
        $document->addField(Field::unStored('message', StringTools::transformSpecialChars($mergedMessages), 'utf-8'));
        */

        foreach ($entity->getTags() as $tag) {
            $document->addField(Field::unStored(
                $tag->getKey(),
                StringTools::transformSpecialChars($tag->getValue()),
                'utf-8'
            ));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function search($query)
    {
        $query = StringTools::transformSpecialChars($query);
        $query = $query." and object:faq";
        $userQuery = QueryParser::parse($query);
        return parent::search($userQuery);
    }
}
