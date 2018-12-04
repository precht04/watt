<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PieceIdentiteRepository")
 */
class PieceIdentite
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
    private $nomPiece;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Prestataire", mappedBy="naturePiece")
     */
    private $prestataires;

    public function __construct()
    {
        $this->prestataires = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPiece(): ?string
    {
        return $this->nomPiece;
    }

    public function setNomPiece(string $nomPiece): self
    {
        $this->nomPiece = $nomPiece;

        return $this;
    }

    /**
     * @return Collection|Prestataire[]
     */
    public function getPrestataires(): Collection
    {
        return $this->prestataires;
    }

    public function addPrestataire(Prestataire $prestataire): self
    {
        if (!$this->prestataires->contains($prestataire)) {
            $this->prestataires[] = $prestataire;
            $prestataire->setNaturePiece($this);
        }

        return $this;
    }

    public function removePrestataire(Prestataire $prestataire): self
    {
        if ($this->prestataires->contains($prestataire)) {
            $this->prestataires->removeElement($prestataire);
            // set the owning side to null (unless already changed)
            if ($prestataire->getNaturePiece() === $this) {
                $prestataire->setNaturePiece(null);
            }
        }

        return $this;
    }
}
