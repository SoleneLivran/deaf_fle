<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"students:list", "student:view"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"students:list", "student:view"})
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"students:list", "student:view"})
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"students:list", "student:view"})
     */
    private $avatar;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"student:view"})
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="students")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     * @Groups({"student:view"})
     */
    private $group;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): self
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(?string $text): self
    {
        $this->text = $text;

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

    public function __toString(): string
    {
        return $this->firstName.' '.$this->lastName;
    }
}
