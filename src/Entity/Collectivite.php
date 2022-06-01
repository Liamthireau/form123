<?php

namespace App\Entity;

use App\Repository\CollectiviteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

#[ORM\Entity(repositoryClass: CollectiviteRepository::class)]
class Collectivite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 100)]
    private $Nom;

    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private $Mail;

    #[ORM\Column(type: 'integer')]
    private $Siren;

    #[ORM\Column(type: 'integer')]
    private $nic;

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'], nullable: true)]
    private $updateAt;

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $createdAt;

    #[ORM\OneToMany(mappedBy: 'collectivite', targetEntity: Compte::class)]
    private $comptes;

    public function __construct()
    {
        $this->comptes = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(?string $Mail): self
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getSiren(): ?int
    {
        return $this->Siren;
    }

    public function setSiren(int $Siren): self
    {
        $this->Siren = $Siren;

        return $this;
    }

    public function getNic(): ?int
    {
        return $this->nic;
    }

    public function setNic(int $nic): self
    {
        $this->nic = $nic;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeImmutable
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeImmutable $updateAt): self
    {
        $this->updateAt = $updateAt;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Compte>
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): self
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes[] = $compte;
            $compte->setCollectivite($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        if ($this->comptes->removeElement($compte)) {
            // set the owning side to null (unless already changed)
            if ($compte->getCollectivite() === $this) {
                $compte->setCollectivite(null);
            }
        }

        return $this;
    }
}
