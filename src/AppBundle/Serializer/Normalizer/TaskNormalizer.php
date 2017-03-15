<?php
namespace AppBundle\Serializer\Normalizer;
use AppBundle\Entity\Task;
use AppBundle\Manager\PriceManager;
use AppBundle\Manager\TravelManager;
use AppBundle\Manager\TravelRateManager;

/**
 * TaskNormalizer.
 */
class TaskNormalizer extends AbstractNormalizer
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
    {
        /* @var Task $object */
        $data = [
            'id'        => $object->getId(),
            'name'      => $object->getName(),
            'status'    => $object->getStatus(),
            'category'  => $this->normalizeObject($object->getCategory(), $format, $context),
        ];
        return $data;
    }


    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null)
    {
        return $data instanceof Task;
    }

}