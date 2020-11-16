<?php

namespace App\Entity;

use App\Repository\MicroserviceCRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MicroserviceCRepository::class)
 */
class MicroserviceC
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $refer;

    /**
     * @ORM\Column(type="boolean")
     */
    private $question;

    /**
     * @ORM\Column(type="integer")
     */
    private $rating;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefer(): ?string
    {
        return $this->refer;
    }

    public function setRefer(string $refer): self
    {
        $this->refer = $refer;

        return $this;
    }

    public function getQuestion(): ?bool
    {
        return $this->question;
    }

    public function setQuestion(bool $question): self
    {
        $this->question = $question;

        return $this;
    }

    public function getRating(): ?int
    {
        return $this->rating;
    }

    public function setRating(int $rating): self
    {
        $this->rating = $rating;

        return $this;
    }
}
