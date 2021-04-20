<?php

namespace App\Entity;

use App\Exception\StudentException;
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
    private ?int $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"students:list", "student:view"})
     */
    private ?string $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"students:list", "student:view"})
     */
    private ?string $lastName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"students:list", "student:view"})
     */
    private ?string $avatar;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"student:view"})
     */
    private ?string $text;

    /**
     * @ORM\ManyToOne(targetEntity=Group::class, inversedBy="students")
     * @ORM\JoinColumn(nullable=true, onDelete="SET NULL")
     * @Groups({"student:view"})
     */
    private ?Group $group;

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

    /**
     * @Groups({"student:view"})
     * @return array<int, string>
     * @throws StudentException
     */
    public function getTextAsSentences(): ?array
    {
        $text = $this->getText();
        if (null === $text) {
            return [];
        }

        $textAsSentences = preg_split('/(?<=\.)\s/', $text);

        if (false === $textAsSentences) {
            throw new StudentException('Splitting text into sentences did not work');
        }

        return $textAsSentences;
    }

    /**
     * @Groups({"student:view"})
     */
    public function getTextAsWords(): array //keeping each word in its sentence
    {
        $text = $this->getTextAsSentences();
        $textAsWords = [];

        foreach ($text as $sentence) {
            $formattedSentence = [];
            $sentenceAsWords = preg_split('/\s(?![!?;:])/', $sentence);
            $formattedSentence[] = $sentenceAsWords;
            $textAsWords[] = $sentenceAsWords;
        }

        return $textAsWords;
    }
}
