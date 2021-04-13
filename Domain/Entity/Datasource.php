<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Domain\Entity;


/**
 * 
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class Datasource
{
    private string $id;
    
    public function getId() :string
    {
        return $this->id;
    }
}
