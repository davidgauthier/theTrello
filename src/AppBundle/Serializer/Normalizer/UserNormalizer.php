<?php
namespace AppBundle\Serializer\Normalizer;
use AppBundle\Entity\User;
use AppBundle\Manager\PriceManager;
use AppBundle\Manager\TravelManager;
use AppBundle\Manager\TravelRateManager;

/**
 * UserNormalizer.
 */
class UserNormalizer extends AbstractNormalizer
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        /* @var User $object */
        $data = [
            'id' => $object->getId(),
            'type' => $object->getType(),
            'category' => $this->normalizeObject($object->getCategory(), $format, $context),
        ];
        return $data;
    }


    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof User;
    }

}