<?php

/**
 * 
 * @author:  Danielle HODIEB <danielle.hodieb@tessi.fr>
 * @license: GPL
 *
 */

namespace Tms\Bundle\FaqBundle\Indexer;

interface IndexerInterface
{
    /**
     * Add a document for the given entity
     *
     * @param object $entity
     */
    public function add($entity);

    /**
     * Delete a document for the given entity
     *
     * @param object $entity
     * @throw MissingIndexedEntityException
     */
    public function delete($entity);

    /**
     * Update a document for the given entity
     *
     * @param object entity
     * @throw MissingIndexedEntityException
     */
    public function update($entity);

    /**
     * Write
     */
    public function write();

    /**
     * Search a document
     *
     * @param object $query
     * @return array
     */
    public function search($query);
}

