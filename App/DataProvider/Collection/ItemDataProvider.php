<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\App\DataProvider\Collection;

use Fantestic\CestManagerBundle\Domain\Entity\Collection;
use Fantestic\CestManagerBundle\Infra\Repository\CollectionRepository;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id as CollectionId;
use Fantestic\CestManagerBundle\Infra\Repository\ScenarioRepository;

/**
 * DataProvider to load Collections into ApiPlatform
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see https://api-platform.com/docs/core/data-providers/
 */
final class ItemDataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    public function __construct(
        private CollectionRepository $collectionRepository
    ) {}


    /**
     * @inheritdoc
     */
    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return (Collection::class === $resourceClass);
    }


    /**
     * @inheritdoc
     */
    public function getItem(string $resourceClass, $id, ?string $operationName = null, array $context = []) :?Collection
    {
        return $this->collectionRepository->find(
            CollectionId::fromStringRepr($id)
        );
    }
}
