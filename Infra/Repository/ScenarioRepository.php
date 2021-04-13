<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Infra\Repository;

use Fantestic\CestManagerBundle\Infra\Repository\CollectionRepository;
use Fantestic\CestManagerBundle\Domain\Entity\Scenario;
use Fantestic\CestManagerBundle\Domain\ValueObject\Scenario\Id as ScenarioId;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id as CollectionId;
use Fantestic\CestManagerBundle\Domain\Exception\ValueObject\InvalidIdentifierStringException;
use Fantestic\CestManagerBundle\Domain\Repository\ScenarioRepositoryInterface;
use Fantestic\CestManagerBundle\Infra\FantesticBridge\CollectionAdapterFactory;
use Fantestic\CestManager\CestReader;
use Fantestic\CestManager\Exception\ClassNotFoundException;
use InvalidArgumentException;

/**
 * 
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class ScenarioRepository implements ScenarioRepositoryInterface
{
    public function __construct(
        private CestReader $cestReader,
        private CollectionRepository $collectionRepository,
        private CollectionAdapterFactory $collectionAdapterFactory
    ) {}


    /**
     * 
     * @param ScenarioId $id 
     * @return null|Scenario
     * @throws InvalidArgumentException
     * @throws InvalidIdentifierStringException
     */
    public function find(ScenarioId $id) :?Scenario
    {
        try {
            $collection = $this->collectionRepository->find(
                CollectionId::fromStringRepr($id->getCollectionIdRepr())
            );
            if (is_null($collection)) {
                return null;
            }
            $scenarioDto = $this->cestReader->getScenario(
                $this->collectionAdapterFactory->makeFromCollection($collection),
                new Scenario($id)
            );
            if (is_null($scenarioDto)) {
                return null;
            }
            return Scenario::fromDto($scenarioDto, $collection->getId());
        } catch (ClassNotFoundException $e) {
            // drop the exception, as it's simply a 404
            return null;
        }
    }
}
