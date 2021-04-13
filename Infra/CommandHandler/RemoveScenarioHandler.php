<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Infra\CommandHandler;

use Fantestic\CestManager\CestWriter;
use Fantestic\CestManagerBundle\Domain\Command\RemoveScenario;
use Fantestic\CestManagerBundle\Domain\Entity\Collection;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id as CollectionId;
use Fantestic\CestManagerBundle\Infra\FantesticBridge\CollectionAdapterFactory;
use Exception;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * CommandHandler to create a new Scenario.
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class RemoveScenarioHandler implements MessageHandlerInterface
{
    public function __construct(
        private CestWriter $cestWriter,
        private CollectionAdapterFactory $fantesticBridge
    ) { }


    public function __invoke(RemoveScenario $removeScenario) :void
    {
        try {
            $scenario = $removeScenario->getScenario();
            $collectionId = CollectionId::fromStringRepr($scenario->getId()->getCollectionIdRepr());
            
            $this->cestWriter->removeScenario(
                $this->collectionAdapterFactory->makeFromCollectionId($collectionId),
                $scenario
            );
        } catch (Exception $e) {
            throw $e;
        }
    }
}
