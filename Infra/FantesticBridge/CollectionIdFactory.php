<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\Infra\FantesticBridge;

use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id as CollectionId;

/**
 * As the CollectionId representing a CestFile will need a prefix (the base namespace),
 * and a Suffix (most commonly Cest), we require a way to create CollectionIds that don't
 * have knowledge about the configured prefix/suffix.
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class CollectionIdFactory
{
    public function __construct(
        private string $prefix,
        private string $suffix
    ) { }

    public function makeFromSubpath(string $subpath) :CollectionId
    {
        $nsNormalized = str_replace('/', Collectionid::NS_SEPARATOR, $subpath);
        return CollectionId::fromStringRepr(
            substr($nsNormalized, 0, -1*strlen($this->suffix.'.php'))
        );
    }
}