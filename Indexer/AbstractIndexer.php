<?php

/**
 * 
 * @author:  Danielle HODIEB <danielle.hodieb@tessi.fr>
 * @license: GPL
 *
 */

namespace Tms\Bundle\FaqBundle\Indexer;

use EWZ\Bundle\SearchBundle\Lucene\LuceneSearch;
use EWZ\Bundle\SearchBundle\Lucene\Document;
use EWZ\Bundle\SearchBundle\Lucene\Lucene;

abstract class AbstractIndexer implements IndexerInterface
{
    protected $indexer;

    /**
     * Constructor
     *
     * @param LuceneSearch
     */
    public function __construct(LuceneSearch $indexer)
    {
        $this->indexer = $indexer;
    }

    /**
     * Get Indexer
     *
     * @return LuceneSearch
     */
    protected function getIndexer()
    {
        return $this->indexer;
    }

    /**
     * Index
     *
     * @param object $entity
     * @param Document $document
     */
    abstract public function index($entity, Document $document);

    /**
     * {@inheritdoc}
     */
    public function add($entity)
    {
        $document = new Document();
        $this->index($entity, $document);
        $this->getIndexer()->addDocument($document);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($entity)
    {
        $document = new Document();
        $this->index($entity, $document);
        $this->getIndexer()->deleteDocument($document);
    }

    /**
     * {@inheritdoc}
     */
    public function update($entity)
    {
        $document = new Document();
        $this->index($entity, $document);
        $this->getIndexer()->updateDocument($document);
    }

    /**
     * {@inheritdoc}
     */
    public function write()
    {
        return $this->getIndexer()->updateIndex();
    }


    /**
     * {@inheritdoc}
     */
    public function search($query)
    {
        return $this->getIndexer()->find($query);
    }
}
