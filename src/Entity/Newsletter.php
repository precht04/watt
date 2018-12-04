<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsletterRepository")
 */
class Newsletter
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emailAbonne;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAbonnement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmailAbonne(): ?string
    {
        return $this->emailAbonne;
    }

    public function setEmailAbonne(string $emailAbonne): self
    {
        $this->emailAbonne = $emailAbonne;

        return $this;
    }

    public function getDateAbonnement(): ?\DateTimeInterface
    {
        return $this->dateAbonnement;
    }

    public function setDateAbonnement(\DateTimeInterface $dateAbonnement): self
    {
        $this->dateAbonnement = $dateAbonnement;

        return $this;
    }
}
