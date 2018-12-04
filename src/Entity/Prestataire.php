<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PrestataireRepository")
 */
class Prestataire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $codePrest;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $nomPrest;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $prenomPrest;

    /**
     * @ORM\Column(type="integer")
     */
    private $telPrest;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $emailPrest;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Localisation", inversedBy="prestataires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $localisation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PieceIdentite", inversedBy="prestataires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $nomPiece;

    /**
     * @ORM\Column(type="datetime")
     */
    private $DateInsPrest;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $numPiece;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\NiveauEtude", inversedBy="prestataires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $niveau;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodePrest(): ?string
    {
        return $this->codePrest;
    }

    public function setCodePrest(string $codePrest): self
    {
        $this->codePrest = $codePrest;

        return $this;
    }

    public function getNomPrest(): ?string
    {
        return $this->nomPrest;
    }

    public function setNomPrest(string $nomPrest): self
    {
        $this->nomPrest = $nomPrest;

        return $this;
    }

    public function getPrenomPrest(): ?string
    {
        return $this->prenomPrest;
    }

    public function setPrenomPrest(string $prenomPrest): self
    {
        $this->prenomPrest = $prenomPrest;

        return $this;
    }

    public function getTelPrest(): ?int
    {
        return $this->telPrest;
    }

    public function setTelPrest(int $telPrest): self
    {
        $this->telPrest = $telPrest;

        return $this;
    }

    public function getEmailPrest(): ?string
    {
        return $this->emailPrest;
    }

    public function setEmailPrest(string $emailPrest): self
    {
        $this->emailPrest = $emailPrest;

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

    public function getNomPiece(): ?PieceIdentite
    {
        return $this->nomPiece;
    }

    public function setNomPiece(?PieceIdentite $nomPiece): self
    {
        $this->nomPiece = $nomPiece;

        return $this;
    }

    public function getDateInsPrest(): ?\DateTimeInterface
    {
        return $this->DateInsPrest;
    }

    public function setDateInsPrest(\DateTimeInterface $DateInsPrest): self
    {
        $this->DateInsPrest = $DateInsPrest;

        return $this;
    }

    public function getNumPiece(): ?string
    {
        return $this->numPiece;
    }

    public function setNumPiece(string $numPiece): self
    {
        $this->numPiece = $numPiece;

        return $this;
    }

    public function getNiveau(): ?NiveauEtude
    {
        return $this->niveau;
    }

    public function setNiveau(?NiveauEtude $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }
}
