<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Infra\Repository;

use Fantestic\CestManagerBundle\Domain\Repository\ActionRepositoryInterface;
use Fantestic\CestManagerBundle\Domain\Entity\Action;
use Fantestic\CestManagerBundle\Infra\ActionProvider\ActionProviderCollection;

/**
 * 
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class ActionRepository implements ActionRepositoryInterface
{
    public function __construct(
        private ActionProviderCollection $actionProviderCollection
    ) {}


    /**
     * Returns a list of all existing Actions
     * 
     * @return iterable|Action[] 
     */
    public function findAll() :iterable
    {
        $actions = [];
        foreach ($this->actionProviderCollection->getActionProviders() as $actionProvider) {
            foreach ($actionProvider->getActions() as $action) {
                $actions[$action->getId()->toString()] = $action;
            }
        }
        return $actions;
    }


    public function find(string $identifier) :?Action
    {
        $actions = (array)($this->findAll());
        return array_key_exists($identifier, $actions)?$actions[$identifier]:null;
    }
}
