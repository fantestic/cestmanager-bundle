<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Domain\ValueObject\Action;


/**
 * Action Parameters
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Parameter
{
    public function __construct(
        private string $name,
        private int $position
    ) { }


    public function getName() :string
    {
        return $this->name;
    }


    public function getPosition() :int
    {
        return $this->position;
    }
}
