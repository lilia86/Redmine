<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;


class Issue
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("int")
     */
    private $id;

    /**
     * @Assert\Type("string")
     */
    private $project;

    /**
     * @Assert\Type("array")
     */
    private $tracker;

    /**
     * @Assert\Type("array")
     */
    private $status;

    /**
     * @Assert\Type("array")
     */
    private $priority;

    /**
     * @Assert\Type("array")
     */
    private $author;

    /**
     * @Assert\Type("string")
     */
    private $subject;

    /**
     * @Assert\Type("integer")
     */
    private $spentHours;

    /**
     * @Assert\Type("text")
     */
    private $description;

    /**
     * @Assert\Date()
     */
    private $start_date;

    /**
     * @Assert\Type("int")
     */
    private $done_racio;

    /**
     * @Assert\Type("float")
     */
    private $estimated_hours;

    /**
     * @Assert\Date()
     */
    private $created_on;

    /**
     * @Assert\Date()
     */
    private $updated_on;

    /**
     * @return mixed
     */
    public function getSpentHours()
    {
        return $this->spentHours;
    }

    /**
     * @param mixed $spentHours
     */
    public function setSpentHours($spentHours): void
    {
        $this->spentHours = $spentHours;
    }


    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }




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

    public function getProject()
    {
        return $this->project;
    }

    public function setProject($project): self
    {
        $this->project = $project;

        return $this;
    }

    public function getTracker(): ?array
    {
        return $this->tracker;
    }

    public function setTracker(?array $tracker): self
    {
        $this->tracker = $tracker;

        return $this;
    }

    public function getStatus(): ?array
    {
        return $this->status;
    }

    public function setStatus(?array $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getPriority(): ?array
    {
        return $this->priority;
    }

    public function setPriority(?array $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getAuthor(): ?array
    {
        return $this->author;
    }

    public function setAuthor(?array $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getString(): ?string
    {
        return $this->string;
    }

    public function setString(?string $string): self
    {
        $this->string = $string;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getDoneRacio(): ?int
    {
        return $this->done_racio;
    }

    public function setDoneRacio(?int $done_racio): self
    {
        $this->done_racio = $done_racio;

        return $this;
    }

    public function getEstimatedHours(): ?float
    {
        return $this->estimated_hours;
    }

    public function setEstimatedHours(?float $estimated_hours): self
    {
        $this->estimated_hours = $estimated_hours;

        return $this;
    }

    public function getCreatedOn(): ?\DateTimeInterface
    {
        return $this->created_on;
    }

    public function setCreatedOn(?\DateTimeInterface $created_on): self
    {
        $this->created_on = $created_on;

        return $this;
    }

    public function getUpdatedOn(): ?\DateTimeInterface
    {
        return $this->updated_on;
    }

    public function setUpdatedOn(?\DateTimeInterface $updated_on): self
    {
        $this->updated_on = $updated_on;

        return $this;
    }
}
