<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\App\DataPersister;

use Fantestic\CestManagerBundle\Domain\Entity\Collection;
use Fantestic\CestManagerBundle\Domain\Command\RemoveCollection;
use Fantestic\CestManagerBundle\Domain\Command\CreateCollection;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Messenger\MessageBusInterface;


/**
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class CollectionDataPersister implements ContextAwareDataPersisterInterface
{
    public function __construct(
        private MessageBusInterface $bus
    ) {}


    public function supports($data, array $context = []): bool
    { 
        return $data instanceof Collection;
    }


    /**
     * 
     * @param Collection $data 
     * @param array $context 
     * @return void 
     */
    public function persist($data, array $context = []) :void
    {
        if ('post' === $context['collection_operation_name']) {
            $this->bus->dispatch(new CreateCollection($data));
        }
    }


    public function remove($data, array $context = []) :void
    {
        $this->bus->dispatch(new RemoveCollection($data));
    }
}
