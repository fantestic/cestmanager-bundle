<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\App\DataPersister;

use Fantestic\CestManagerBundle\Domain\Command\RemoveScenario;
use Fantestic\CestManagerBundle\Domain\Command\CreateScenario;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Fantestic\CestManagerBundle\Domain\Command\UpdateScenario;
use Fantestic\CestManagerBundle\Domain\Entity\Scenario;
use Fantestic\CestManagerBundle\Domain\ValueObject\Scenario\Step;
use Fantestic\CestManagerBundle\Domain\Entity\Action;
use Fantestic\CestManagerBundle\Domain\ValueObject\Action\Id as ActionId;
use Fantestic\CestManagerBundle\Domain\ValueObject\Scenario\Argument;
use Symfony\Component\Messenger\MessageBusInterface;


/**
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class ScenarioDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(
        private MessageBusInterface $bus
    ) {}


    public function supports($data, array $context = []): bool
    {
        return $data instanceof Scenario;
    }


    /**
     * 
     * @param Scenario $data 
     * @param array $context 
     * @return void 
     */
    public function persist($data, array $context = []) :void
    {
        $operation = $context['item_operation_name'] ?? $context['collection_operation_name'];
        if ('put' === $operation) {
            // @TODO Fix to use $data
            $rawContent = (json_decode(file_get_contents("php://input"), true));

            $steps = [];
            foreach ($rawContent['steps'] as $step) {
                $arguments = [];
                foreach ($step['arguments'] as $argument) {
                    $arguments[] = new Argument($argument['position'], $argument['value']);
                }
                $steps[] = new Step(
                    $step['position'],
                    new Action(ActionId::fromString($step['action']['id']), $step['action']['readable'], []),
                    $arguments
                );
            }
            $data->setSteps($steps);
            $this->bus->dispatch(new UpdateScenario($data));
        } elseif ('post' === $operation) {
            $this->bus->dispatch(new CreateScenario($data));
        }
    }

    /**
     * 
     * @param Scenario $data 
     * @param array $context 
     * @return void 
     */
    public function remove($scenario, array $context = []) :void
    {
        /*
        $scenario->setCollection(
            new Collection(
                $this->collectionIdFactory->fromScenarioId($scenario->getId())
            )
        );*/
        $this->bus->dispatch(new RemoveScenario($scenario));
    }
}
