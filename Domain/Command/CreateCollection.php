<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Domain\Command;

use Fantestic\CestManagerBundle\Domain\Entity\Collection;

/**
 * Command to create a Collection.
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class CreateCollection
{
    public function __construct(
        private Collection $collection
    ) { }


    public function getCollection() :Collection
    {
        return $this->collection;
    }
}
