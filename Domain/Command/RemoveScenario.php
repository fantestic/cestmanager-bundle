<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Domain\Command;

use Fantestic\CestManagerBundle\Domain\Entity\Scenario;

/**
 * Command to delete a Scenario from the system.
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
class RemoveScenario
{
    public function __construct(
        private Scenario $scenario
    ) { }


    public function getScenario() :Scenario
    {
        return $this->scenario;
    }
}
