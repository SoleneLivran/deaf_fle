<?php

namespace App\Entity;

use App\Repository\WordRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=WordRepository::class)
 */
class Word
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"words:list"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"words:list"})
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     * @Groups({"words:list"})
     */
    private $definition;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="words")
     * @ORM\JoinColumn(nullable=false)
     */
    private $group;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDefinition(): ?string
    {
        return $this->definition;
    }

    public function setDefinition(string $definition): self
    {
        $this->definition = $definition;

        return $this;
    }

    public function getGroup(): ?Group
    {
        return $this->group;
    }

    public function setGroup(?Group $group): self
    {
        $this->group = $group;

        return $this;
    }
}
