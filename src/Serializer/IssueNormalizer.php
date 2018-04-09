<?php

namespace App\Serializer;

use App\Entity\Issue;
use App\Entity\Project;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyInfo\PropertyTypeExtractorInterface;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\NameConverter\NameConverterInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

class IssueNormalizer extends ObjectNormalizer
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!$this->serializer instanceof DenormalizerInterface) {
            throw new LogicException('Cannot normalize attributes because injected serializer is not a normalizer');
        }

        if (array_key_exists('issues', $data)) {
            foreach($data['issues'] as $item) {
                $issue = new Issue();
                $issue->setId($item['id']);
                $issue->setProject($item['project']);
                $issue->setTracker($item['tracker']);
                $issue->setStatus($item['status']);
                $issue->setPriority($item['priority']);
                $issue->setAuthor($item['author']);
                $issue->setSubject($item['subject']);
                $issues[] = $issue;
            }
            $issues = array_reverse($issues, true);

        }else{
            $issues = new Issue();
            $issues->setId($data['issue']['id']);
            $issues->setProject($data['issue']['project']);
            $issues->setTracker($data['issue']['tracker']);
            $issues->setAuthor($data['issue']['author']);
            $issues->setSubject($data['issue']['subject']);
            $issues->setDescription($data['issue']['description']);
            $issues->setSpentHours($data['issue']['spent_hours']);
        }


        return $issues;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type != Issue::class) {
            return false;
        }

        return true;
    }
}
