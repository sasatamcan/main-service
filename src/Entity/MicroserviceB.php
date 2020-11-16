<?php

namespace App\Entity;


use App\Repository\MicroserviceBRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MicroserviceBRepository::class)
 */
class MicroserviceB
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $notification;

    /**
     * @ORM\Column(type="array")
     */
    private $payments = [];


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getNotification(): ?bool
    {
        return $this->notification;
    }

    public function setNotification(bool $notification): self
    {
        $this->notification = $notification;

        return $this;
    }

    public function getPayments(): ?array
    {
        return $this->payments;
    }

    public function setPayments(array $payments): self
    {
        $this->payments = $payments;

        return $this;
    }
}
