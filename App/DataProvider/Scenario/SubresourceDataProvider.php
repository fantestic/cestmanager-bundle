<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\App\DataProvider\Scenario;

use Fantestic\CestManagerBundle\Infra\Repository\CollectionRepository;
use Fantestic\CestManagerBundle\Infra\FantesticBridge\CollectionAdapterFactory;
use Fantestic\CestManagerBundle\Domain\Exception\ValueObject\InvalidIdentifierStringException;
use Fantestic\CestManagerBundle\Domain\Entity\Scenario;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id as CollectionId;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\SubresourceDataProviderInterface;
use Fantestic\CestManager\CestReader;
use Fantestic\CestManager\Exception\ClassNotFoundException;
use LogicException;
use Fantestic\CestManager\Exception\UnprocessableScenarioException;


/**
 * DataProvider to load Collections into ApiPlatform
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 * @see https://api-platform.com/docs/core/data-providers/
 */
final class SubresourceDataProvider implements RestrictedDataProviderInterface, SubresourceDataProviderInterface
{
    public function __construct(
        private CollectionRepository $collectionRepository,
        private CestReader $cestReader,
        private CollectionAdapterFactory $collectionAdapterFactory
    ) { }

    public function supports(string $resourceClass, ?string $operationName = null, array $context = []): bool
    {
        return Scenario::class === $resourceClass;
    }

    /**
     * 
     * @param string $resourceClass 
     * @param array $identifiers 
     * @param array $context 
     * @param string|null $operationName 
     * @return iterable|Scenario[]
     * @throws ClassNotFoundException
     * @throws LogicException
     * @throws UnprocessableScenarioException
     */
    public function getSubresource(string $resourceClass, array $identifiers, array $context, ?string $operationName = null) :?iterable
    {
        $collectionId = CollectionId::fromStringRepr($identifiers['id']['id']);
        $adapter = $this->collectionAdapterFactory->makeFromCollectionId($collectionId);
        try {
            $collectionDto = $this->cestReader->getCollection(
                $adapter
            );
            foreach ($collectionDto->getScenarios() as $scenario) {
                yield Scenario::fromDto($scenario, $collectionId);
            }
        } catch (InvalidIdentifierStringException $e) {
            return null;
        } catch (ClassNotFoundException | LogicException | UnprocessableScenarioException $e) {
            throw $e;
        }
    }
}
