<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Domain\Entity;

use Fantestic\CestManagerBundle\Domain\Entity\Scenario;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id;

/**
 * 
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Collection
{
    private Id $id;

    /**
     * 
     * @var Scenario[]
     */
    private $scenarios = [];

    public function __construct(Id $id)
    {
        $this->id = $id;
    }

    public function getId() :Id
    {
        return $this->id;
    }


    /**
     * 
     * @return iterable|Scenario[]
     */
    public function getScenarios() :iterable
    {
        return $this->scenarios;
    }


    public function addScenario(Scenario $scenario) :self
    {
        $this->scenarios[] = $scenario;
        return $this;
    }


    public function setScenarios(iterable $scenarios) :self
    {
        $this->scenarios = [];
        foreach ($scenarios as $scenario) {
            $this->scenarios[] = $scenario;
        }
        return $this;
    }
}
