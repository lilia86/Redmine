<?php

namespace App\Serializer;

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

class ProjectNormalizer extends ObjectNormalizer
{
    /**
     * {@inheritdoc}
     */
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        if (!$this->serializer instanceof DenormalizerInterface) {
            throw new LogicException('Cannot normalize attributes because injected serializer is not a normalizer');
        }




       /*    $projects = $this->denormalize($data, 'Project', null); */

          if (array_key_exists('projects', $data)) {
               foreach($data['projects'] as $item) {

                   $project = new Project();
                   $project->setId($item['id']);
                   $project->setName($item['name']);
                   $project->setIdentifier($item['identifier']);
                   $project->setStatus($item['status']);
                   $project->setCreatedOn($item['created_on']);
                   $projects[] = $project;
            }

               }else{
                   $projects = new Project();
                   $projects->setId($data['project']['id']);
                   $projects->setName($data['project']['name']);
                   $projects->setIdentifier($data['project']['identifier']);
                   $projects->setIdentifier($data['project']['description']);
        }

        return $projects;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null)
    {
        if ($type != Project::class) {
            return false;
        }

        return true;
    }
}
