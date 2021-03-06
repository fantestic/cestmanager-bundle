<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Domain\Entity;

use Fantestic\CestManagerBundle\Domain\ValueObject\Action\Id;
use Fantestic\CestManagerBundle\Domain\ValueObject\Action\Parameter;
use Fantestic\CestManager\Contract\ActionInterface;
use Fantestic\CestManager\Dto\Action as ActionDto;
/**
 * 
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Action implements ActionInterface
{
    private Id $id;
    /**
     * @var Parameter[]
     */
    private iterable $parameters;
    private string $readable;

    public function __construct(Id $id, string $readable, iterable $parameters)
    {
        $this->id = $id;
        $this->readable = $readable;
        $this->parameters = $parameters;
    }


    public static function fromDto(ActionDto $actionDto) :Action
    {
        return new self(
            Id::fromString($actionDto->getMethodName()),
            $actionDto->getMethodName(),
            $actionDto->getParameters()
        );
    }


    public function getMethodName(): string 
    {
        return $this->id->toString();
    }


    public function getId() :Id
    {
        return $this->id;
    }


    /**
     * 
     * @return Parameter[] 
     */
    public function getParameters() :iterable
    {
        foreach ($this->parameters as $parameter) {
            yield $parameter;
        }
    }


    public function getReadable() :string
    {
        return $this->readable;
    }
}
