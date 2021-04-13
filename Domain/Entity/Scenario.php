<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Domain\Entity;

use Fantestic\CestManagerBundle\Domain\Entity\Collection;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id as CollectionId;
use Fantestic\CestManagerBundle\Domain\ValueObject\Scenario\Id;
use Fantestic\CestManagerBundle\Domain\ValueObject\Scenario\Step;
use Fantestic\CestManager\Contract\ScenarioInterface;
use Fantestic\CestManager\Dto\Scenario as ScenarioDto;

/**
 * 
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Scenario implements ScenarioInterface
{
    private Id $id;

    /**
     * @Xvar Collection
     *
    private ?Collection $collection = null;
    */

    /**
     * @var Step[]
     */
    private array $steps = [];


    public function __construct(Id $id)
    {
        $this->id = $id;
    }


    public static function fromDto(ScenarioDto $dto, CollectionId $collectionId) :Scenario
    {
        $id = Id::fromString(
            $collectionId->toString() . Id::ID_SEPARATOR . $dto->getMethodName()
        );
        $instance = new self($id);
        foreach ($dto->getSteps() as $step) {
            $instance->addStep(Step::fromDto($step));
        }
        return $instance;
    }

    public function getMethodName(): string
    {
        return $this->id->getMethodName();
    }

    public function getId() :Id
    {
        return $this->id;
    }


    public function setId(Id $id) :self
    {
        $this->id = $id;
        return $this;
    }
/*
    public function getCollection() :?Collection
    {
        return $this->collection;
    }

    public function setCollection(Collection $collection) :self
    {
        $this->collection = $collection;
        return $this;
    }
    */

    /**
     * 
     * @return iterable|Step[]
     */
    public function getSteps() :iterable
    {
        return $this->steps;
    }

    public function addStep(Step $step) :self
    {
        $this->steps[] = $step;
        return $this;
    }

    public function setSteps(array $steps) :self
    {
        $this->steps = [];
        foreach ($steps as $step) {
            $this->addStep($step);
        }
        return $this;
    }
}
