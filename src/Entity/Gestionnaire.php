<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GestionnaireRepository")
 */
class Gestionnaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $codeGest;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomGest;

    /**
     * @ORM\Column(type="integer")
     */
    private $telGest;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $emailGest;

    /**
     * @ORM\Column(type="text")
     */
    private $infosComplement;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $typeGest;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateInsGest;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localisation", inversedBy="gestionnaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $localisation;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeGest(): ?string
    {
        return $this->codeGest;
    }

    public function setCodeGest(string $codeGest): self
    {
        $this->codeGest = $codeGest;

        return $this;
    }

    public function getNomGest(): ?string
    {
        return $this->nomGest;
    }

    public function setNomGest(string $nomGest): self
    {
        $this->nomGest = $nomGest;

        return $this;
    }

    public function getTelGest(): ?int
    {
        return $this->telGest;
    }

    public function setTelGest(int $telGest): self
    {
        $this->telGest = $telGest;

        return $this;
    }

    public function getEmailGest(): ?string
    {
        return $this->emailGest;
    }

    public function setEmailGest(string $emailGest): self
    {
        $this->emailGest = $emailGest;

        return $this;
    }


    public function getInfosComplement(): ?string
    {
        return $this->infosComplement;
    }

    public function setInfosComplement(string $infosComplement): self
    {
        $this->infosComplement = $infosComplement;

        return $this;
    }

    public function getTypeGest(): ?string
    {
        return $this->typeGest;
    }

    public function setTypeGest(string $typeGest): self
    {
        $this->typeGest = $typeGest;

        return $this;
    }

    public function getDateInsGest(): ?\DateTimeInterface
    {
        return $this->dateInsGest;
    }

    public function setDateInsGest(\DateTimeInterface $dateInsGest): self
    {
        $this->dateInsGest = $dateInsGest;

        return $this;
    }

    public function getLocalisation(): ?Localisation
    {
        return $this->localisation;
    }

    public function setLocalisation(?Localisation $localisation): self
    {
        $this->localisation = $localisation;

        return $this;
    }

}
