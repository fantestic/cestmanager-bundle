<?php

declare(strict_types = 1);
namespace Fantestic\CestManagerBundle\App\Normalizer\Collection;

use ApiPlatform\Core\Exception\InvalidIdentifierException;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id;
use Fantestic\CestManagerBundle\Domain\Exception\ValueObject\InvalidIdentifierStringException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Fantestic\CestManagerBundle\Domain\ValueObject\Collection\Id as CollectionId;

/**
 * 
 * 
 * @package Fantestic/CestManagerBundle
 * @author Gerald Baumeister <gerald@fantestic.io>
 * @license http://www.apache.org/licenses/LICENSE-2.0
 */
final class IdDenormalizer implements DenormalizerInterface
{
    public function denormalize($data, string $type, ?string $format = null, array $context = [])
    {
        try {
            return CollectionId::fromStringRepr($data);
        } catch (InvalidIdentifierStringException $e) {
            throw new InvalidIdentifierException($e->getMessage());
        }
    }

    public function supportsDenormalization($data, string $type, ?string $format = null)
    {
        return is_a($type, id::class, true);
     }
}
