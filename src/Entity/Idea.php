<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IdeaRepository")
 */
class Idea
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $idea;

    /**
     * @ORM\Column(type="datetime",nullable=true)
     */
    private $dateCreation;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vote", mappedBy="idea", orphanRemoval=true)
     */
    private $vote;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ideas")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    public function __construct()
    {
        $this->vote = new ArrayCollection();
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdea(): ?string
    {
        return $this->idea;
    }

    public function setIdea(string $idea): self
    {
        $this->idea = $idea;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getVote(): ?Vote
    {
        return $this->vote;
    }

    public function setVote(Vote $vote): self
    {
        $this->vote = $vote;

        // set the owning side of the relation if necessary
        if ($this !== $vote->getIdea()) {
            $vote->setIdea($this);
        }

        return $this;
    }

    public function addVote(Vote $vote): self
    {
        if (!$this->vote->contains($vote)) {
            $this->vote[] = $vote;
            $vote->setIdea($this);
        }

        return $this;
    }

    public function removeVote(Vote $vote): self
    {
        if ($this->vote->contains($vote)) {
            $this->vote->removeElement($vote);
            // set the owning side to null (unless already changed)
            if ($vote->getIdea() === $this) {
                $vote->setIdea(null);
            }
        }

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }
}
