<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Domain\Repository;

use Fantestic\CestManagerBundle\Domain\Entity\Collection;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id;

/**
 * Repository to locate Collections
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
interface CollectionRepositoryInterface
{
    /**
     * @return iterable|Action[] 
     */
    public function findAll() :iterable;

    public function find(Id $id) :?Collection;
}
