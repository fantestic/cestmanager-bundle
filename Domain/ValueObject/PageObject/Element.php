<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Domain\ValueObject\PageObject;

/**
 * 
 * 
 * @package Fantestic/ApiPlatform
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Element
{
    public function __construct(
        private string $selector,
        private string $alias
    ) {}
}
