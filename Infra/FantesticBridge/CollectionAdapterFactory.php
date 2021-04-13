<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Infra\FantesticBridge;

use Fantestic\CestManagerBundle\Domain\Entity\Collection;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id as CollectionId;

/**
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class CollectionAdapterFactory
{
    public function __construct(
        private string $prefix,
        private string $suffix
    ) { }

    public function makeFromCollection(Collection $collection)
    {
        return new CollectionAdapter($collection->getId(), $this->prefix, $this->suffix);
    }

    public function makeFromCollectionId(CollectionId $collectionId)
    {
        return new CollectionAdapter($collectionId, $this->prefix, $this->suffix);
    }

    public function makeFromSubpath(string $subpath) :CollectionAdapter
    {
        $nsNormalized = str_replace('/', CollectionId::NS_SEPARATOR, $subpath);
        $collectionId = CollectionId::fromStringRepr(
            substr($nsNormalized, 0, -1*strlen($this->suffix.'.php'))
        );
        return $this->makeFromCollectionId($collectionId);
    }
}
