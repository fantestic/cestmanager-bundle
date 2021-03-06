<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Infra\CommandHandler;

use Fantestic\CestManager\CestWriter;
use Fantestic\CestManagerBundle\Domain\Command\CreateCollection;
use Fantestic\CestManagerBundle\Infra\FantesticBridge\CollectionAdapterFactory;
use Exception;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

/**
 * CommandHandler to create a new Command.
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class CreateCollectionHandler implements MessageHandlerInterface
{
    public function __construct(
        private CestWriter $cestWriter,
        private CollectionAdapterFactory $collectionAdapterFactory
    ) { }


    public function __invoke(CreateCollection $createCollection) :void
    {
        try {
            $this->cestWriter->createCest(
                $this->collectionAdapterFactory->makeFromCollection(
                    $createCollection->getCollection()
                )
            );
        } catch (Exception $e) {
            throw $e;
        }
    }
}
