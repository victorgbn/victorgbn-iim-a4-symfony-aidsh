<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MissionRepository::class)
 */
#[ApiResource]
class Mission
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $deadline;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $completionDate;

    /**
     * @ORM\ManyToOne(targetEntity=Priority::class, inversedBy="mission")
     */
    private $priority;

    /**
     * @ORM\ManyToOne(targetEntity=Status::class, inversedBy="mission")
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity=Villain::class, inversedBy="missions")
     */
    private $villain;

    public function __construct()
    {
        $this->villain = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDeadline(): ?\DateTimeInterface
    {
        return $this->deadline;
    }

    public function setDeadline(\DateTimeInterface $deadline): self
    {
        $this->deadline = $deadline;

        return $this;
    }

    public function getCompletionDate(): ?\DateTimeInterface
    {
        return $this->completionDate;
    }

    public function setCompletionDate(?\DateTimeInterface $completionDate): self
    {
        $this->completionDate = $completionDate;

        return $this;
    }

    public function getPriority(): ?Priority
    {
        return $this->priority;
    }

    public function setPriority(?Priority $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Villain[]
     */
    public function getVillain(): Collection
    {
        return $this->villain;
    }

    public function addVillain(Villain $villain): self
    {
        if (!$this->villain->contains($villain)) {
            $this->villain[] = $villain;
        }

        return $this;
    }

    public function removeVillain(Villain $villain): self
    {
        $this->villain->removeElement($villain);

        return $this;
    }
}
