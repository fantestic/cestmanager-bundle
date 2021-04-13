<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Domain\Command;

use Fantestic\CestManagerBundle\Domain\Entity\Collection;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id as CollectionId;

/**
 * Command to delete a Collection from the system.
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class RemoveCollection
{
    public function __construct(
        private Collection $collection
    ) {}


    public function getCollectionId() :CollectionId
    {
        return $this->collection->getid();
    }
}
