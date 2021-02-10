<?php

namespace App\Entity;

use App\Repository\GroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GroupRepository::class)
 * @ORM\Table(name="`group`")
 */
class Group
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Teacher::class, inversedBy="groups")
     */
    private $teachers;

    /**
     * @ORM\OneToMany(targetEntity=Student::class, mappedBy="group")
     */
    private $students;

    /**
     * @ORM\OneToMany(targetEntity=Word::class, mappedBy="group", orphanRemoval=true)
     */
    private $words;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct()
    {
        $this->teachers = new ArrayCollection();
        $this->students = new ArrayCollection();
        $this->words = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Teacher[]
     */
    public function getTeachers(): Collection
    {
        return $this->teachers;
    }

    public function addTeacher(Teacher $teacher): self
    {
        if (!$this->teachers->contains($teacher)) {
            $this->teachers[] = $teacher;
        }

        return $this;
    }

    public function removeTeacher(Teacher $teacher): self
    {
        $this->teachers->removeElement($teacher);

        return $this;
    }

    /**
     * @return Collection|Student[]
     */
    public function getStudents(): Collection
    {
        return $this->students;
    }

    public function addStudent(Student $student): self
    {
        if (!$this->students->contains($student)) {
            $this->students[] = $student;
            $student->setGroup($this);
        }

        return $this;
    }

    public function removeStudent(Student $student): self
    {
        if ($this->students->removeElement($student)) {
            // set the owning side to null (unless already changed)
            if ($student->getGroup() === $this) {
                $student->setGroup(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Word[]
     */
    public function getWords(): Collection
    {
        return $this->words;
    }

    public function addWord(Word $word): self
    {
        if (!$this->words->contains($word)) {
            $this->words[] = $word;
            $word->setGroup($this);
        }

        return $this;
    }

    public function removeWord(Word $word): self
    {
        if ($this->words->removeElement($word)) {
            // set the owning side to null (unless already changed)
            if ($word->getGroup() === $this) {
                $word->setGroup(null);
            }
        }

        return $this;
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

    public function __toString(): string
    {
        return $this->name;
    }
}
