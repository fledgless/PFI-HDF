<?php

namespace App\Entity;

use App\Model\TimeStampInterface;
use App\Repository\ArticleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article implements TimeStampInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $soustitre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $resume = null;

    #[ORM\Column(length: 255)]
    private ?string $couleur = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $contenu = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createdAt = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $updatedAt = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $nomFichierMiniature = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $texteAlternatifMiniature = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSoustitre(): ?string
    {
        return $this->soustitre;
    }

    public function setSoustitre(?string $soustitre): static
    {
        $this->soustitre = $soustitre;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): static
    {
        $this->resume = $resume;

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): static
    {
        $this->couleur = $couleur;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(?string $contenu): static
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getNomFichierMiniature(): ?string
    {
        return $this->nomFichierMiniature;
    }

    public function setNomFichierMiniature(?string $nomFichierMiniature): static
    {
        $this->nomFichierMiniature = $nomFichierMiniature;

        return $this;
    }

    public function getTexteAlternatifMiniature(): ?string
    {
        return $this->texteAlternatifMiniature;
    }

    public function setTexteAlternatifMiniature(?string $texteAlternatifMiniature): static
    {
        $this->texteAlternatifMiniature = $texteAlternatifMiniature;

        return $this;
    }
}
