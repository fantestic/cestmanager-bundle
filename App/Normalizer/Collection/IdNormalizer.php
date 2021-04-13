<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\App\Normalizer\Collection;

use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id as CollectionId;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * 
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class IdNormalizer implements NormalizerInterface
{

    public function normalize($object, ?string $format = null, array $context = [])
    {
        return $object->toString();
    }

    public function supportsNormalization($data, ?string $format = null)
    {
        return ($data instanceof CollectionId);
        
    }

}