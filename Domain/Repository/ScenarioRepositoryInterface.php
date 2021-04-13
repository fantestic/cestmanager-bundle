<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Domain\Repository;

use Fantestic\CestManagerBundle\Domain\Entity\Scenario;
use Fantestic\CestManagerBundle\Domain\ValueObject\Scenario\Id as ScenarioId;

/**
 * Repository to locate Scenarios
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
interface ScenarioRepositoryInterface
{
    public function find(ScenarioId $id) :?Scenario;
}
