<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Domain\Entity;

use Fantestic\CestManagerBundle\Domain\ValueObject\PageObject\Element;

/**
 * A Datasource gives access to fixtures.
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class PageObject
{
    private string $id;

    private string $route;

    private iterable $fillables;

    private iterable $clickables;

    public function getId() :string
    {
        return $this->id;
    }

    public function getRoute() :string
    {
        return $this->route;
    }

    /**
     * 
     * @return iterable | Element[]
     */
    public function getFillables() :iterable
    {
        return $this->fillables;
    }

    /**
     * 
     * @return iterable | Element[]
     */
    public function getClickables() :iterable
    {
        return $this->clickables;
    }
}
