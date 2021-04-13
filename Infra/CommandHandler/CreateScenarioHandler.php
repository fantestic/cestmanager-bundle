<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Infra\CommandHandler;

use Fantestic\CestManagerBundle\Domain\Entity\Collection;
use Fantestic\CestManagerBundle\Domain\ValueObject\Scenario\Id as ScenarioId;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id as CollectionId;
use Fantestic\CestManagerBundle\Domain\Command\CreateScenario;
use Fantestic\CestManagerBundle\Infra\FantesticBridge\CollectionAdapterFactory;
use Exception;
use Fantestic\CestManager\CestWriter;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * CommandHandler to create a new Scenario.
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class CreateScenarioHandler implements MessageHandlerInterface
{
    public function __construct(
        private CestWriter $cestWriter,
        private CollectionAdapterFactory $collectionAdapterFactory
    ) { }


    public function __invoke(CreateScenario $createScenario) :void
    {
        try {
            $collectionId = CollectionId::fromStringRepr(
                $createScenario->getScenario()->getId()->getCollectionIdRepr()
            );
            $this->cestWriter->createScenario(
                $this->collectionAdapterFactory->makeFromCollectionId($collectionId),
                $createScenario->getScenario()
            );
        } catch (Exception $e) {
            throw $e;
        }
    }
}
