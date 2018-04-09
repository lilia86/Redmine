<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;



class Project
{
    /**
     *
     * @Assert\NotBlank()
     * @Assert\Type("int")
     *
     */
    private $id;

    /**
     * @Assert\Type("string")
     *
     */
    private $name;

    /**
     * @Assert\Type("string")
     *
     */
    private $identifier;

    /**
     * @Assert\Type("string")
     *
     */
    private $description;

    /**
     * @Assert\Type("int")
     *
     */
    private $status;

    /**
     * @Assert\Date()
     *
     */
    private $created_on;

    /**
     * @Assert\Date()
     *
     */
    private $updated_on;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @param mixed $identifier
     */
    public function setIdentifier($identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getCreatedOn()
    {
        return $this->created_on;
    }

    /**
     * @param mixed $created_on
     */
    public function setCreatedOn($created_on): void
    {
        $this->created_on = $created_on;
    }

    /**
     * @return mixed
     */
    public function getUpdatedOn()
    {
        return $this->updated_on;
    }

    /**
     * @param mixed $updated_on
     */
    public function setUpdatedOn($updated_on): void
    {
        $this->updated_on = $updated_on;
    }


}
