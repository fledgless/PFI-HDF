<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, Page>
     */
    #[ORM\OneToMany(targetEntity: Page::class, mappedBy: 'category')]
    private Collection $pages;

    // #[ORM\Column(length: 255)]
    // private ?string $slug = null;

    // #[ORM\Column(length: 255, nullable: true)]
    // private ?string $description = null;

    public function __construct()
    {
        $this->pages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Page>
     */
    public function getPages(): Collection
    {
        return $this->pages;
    }

    public function addPage(Page $page): static
    {
        if (!$this->pages->contains($page)) {
            $this->pages->add($page);
            $page->setCategory($this);
        }

        return $this;
    }

    public function removePage(Page $page): static
    {
        if ($this->pages->removeElement($page)) {
            // set the owning side to null (unless already changed)
            if ($page->getCategory() === $this) {
                $page->setCategory(null);
            }
        }

        return $this;
    }

    // public function getSlug(): ?string
    // {
    //     return $this->slug;
    // }

    // public function setSlug(string $slug): static
    // {
    //     $this->slug = $slug;

    //     return $this;
    // }

    // public function getDescription(): ?string
    // {
    //     return $this->description;
    // }

    // public function setDescription(?string $description): static
    // {
    //     $this->description = $description;

    //     return $this;
    // }
}
