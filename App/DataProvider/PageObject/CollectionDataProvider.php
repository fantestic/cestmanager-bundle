<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\App\DataProvider\PageObject;

use Fantestic\CestManagerBundle\Domain\Entity\PageObject;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;

/**
 * 
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see https://api-platform.com/docs/core/data-providers/
 */
final class CollectionDataProvider implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return PageObject::class === $resourceClass;
    }


    /**
     * 
     * @param string $resourceClass 
     * @param string|null $operationName 
     * @param array $context 
     * @return iterable|Collection[]
     */
    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        return $this->collectionRepository->findAll();
    }
}
