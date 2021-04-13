<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Infra\CommandHandler;

use Fantestic\CestManagerBundle\Domain\Entity\Collection;
use Fantestic\CestManagerBundle\Domain\Command\UpdateScenario;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id as CollectionId;
use Fantestic\CestManagerBundle\Infra\FantesticBridge\CollectionAdapterFactory;
use Exception;
use Fantestic\CestManager\CestWriter;
use Fantestic\CestManager\CestReader;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * CommandHandler to update a Scenario.
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class UpdateScenarioHandler implements MessageHandlerInterface
{
    public function __construct(
        private CestWriter $cestWriter,
        private CestReader $cestReader,
        private CollectionAdapterFactory $collectionAdapterFactory
    ) { }


    public function __invoke(UpdateScenario $updateScenario) :void
    {
        try {
            $collection = new Collection(
                CollectionId::fromStringRepr(
                    $updateScenario->getScenario()->getId()->getCollectionIdRepr()
                )
            );
            $collectionAdapter = $this->collectionAdapterFactory->makeFromCollection($collection);
            if (!$this->cestReader->hasScenario(
                $collectionAdapter,
                $updateScenario->getScenario())
            ) {
                $this->cestWriter->createScenario(
                    $collectionAdapter,
                    $updateScenario->getScenario()
                );
            } else {
                $this->cestWriter->updateScenario(
                    $collectionAdapter,
                    $updateScenario->getScenario()
                );
            }
        } catch (Exception $e) {
            throw $e;
        }
    }
}
