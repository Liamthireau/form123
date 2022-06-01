<?php

namespace App\Entity;

use App\Repository\CompteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompteRepository::class)]
class Compte
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 60, nullable: true)]
    private $uid;

    #[ORM\Column(type: 'string', length: 100)]
    private $prenom;

    #[ORM\Column(type: 'string', length: 100)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $mail;

    #[ORM\Column(type: 'boolean')]
    private $referent;

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'], nullable: true)]
    private $updateAt;

    #[ORM\Column(type: 'datetime_immutable', options: ['default' => 'CURRENT_TIMESTAMP'])]
    private $createAt;

    #[ORM\ManyToOne(targetEntity: Etat::class, inversedBy: 'comptes')]
    private $etat;

    #[ORM\ManyToOne(targetEntity: Collectivite::class, inversedBy: 'comptes')]
    private $collectivite;

    #[ORM\ManyToMany(targetEntity: Extranet::class, inversedBy: 'comptes')]
    private $extranet;

    public function __construct()
    {
        $this->extranet = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUid(): ?string
    {
        return $this->uid;
    }

    public function setUid(?string $uid): self
    {
        $this->uid = $uid;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    public function isReferent(): ?bool
    {
        return $this->referent;
    }

    public function setReferent(bool $referent): self
    {
        $this->referent = $referent;

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

    public function getCreateAt(): ?\DateTimeImmutable
    {
        return $this->createAt;
    }

    public function setCreateAt(?\DateTimeImmutable $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function getEtat(): ?Etat
    {
        return $this->etat;
    }

    public function setEtat(?Etat $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getCollectivite(): ?Collectivite
    {
        return $this->collectivite;
    }

    public function setCollectivite(?Collectivite $collectivite): self
    {
        $this->collectivite = $collectivite;

        return $this;
    }

    /**
     * @return Collection<int, Extranet>
     */
    public function getExtranet(): Collection
    {
        return $this->extranet;
    }

    public function addExtranet(Extranet $extranet): self
    {
        if (!$this->extranet->contains($extranet)) {
            $this->extranet[] = $extranet;
        }

        return $this;
    }

    public function removeExtranet(Extranet $extranet): self
    {
        $this->extranet->removeElement($extranet);

        return $this;
    }
}
