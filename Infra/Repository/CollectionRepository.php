<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Infra\Repository;

use Fantestic\CestManagerBundle\Domain\Entity\Collection;
use Fantestic\CestManagerBundle\Domain\Repository\CollectionRepositoryInterface;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id as CollectionId;
use Fantestic\CestManagerBundle\Infra\FantesticBridge\CollectionAdapter;
use Fantestic\CestManagerBundle\Infra\FantesticBridge\CollectionAdapterFactory;
use Fantestic\CestManagerBundle\Infra\FantesticBridge\CollectionIdFactory;
use Fantestic\CestManager\Finder;

/**
 * 
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class CollectionRepository implements CollectionRepositoryInterface
{
    public function __construct(
        private Finder $finder,
        private CollectionIdFactory $collectionIdFactory,
        private CollectionAdapterFactory $collectionAdapterFactory
    ) {}


    /**
     * Returns a list of all existing Collections
     * 
     * @return iterable|Collection[] 
     */
    public function findAll() :iterable
    {
        foreach ($this->finder->listFiles() as $path) {
            yield new Collection(
                $this->collectionIdFactory->makeFromSubpath($path)
            );
        }
    }


    /**
     * Finds a collection or returns null if the collection cant be found.
     * 
     * @param Id $id 
     * @return null|Collection 
     */
    public function find(CollectionId $id) :?Collection
    {
        $adapter = $this->collectionAdapterFactory->makeFromCollectionId($id);
        if ($this->finder->hasFile($adapter->getSubpath())) {
            return new Collection($id);
        } else {
            return null;
        }
    }
}
