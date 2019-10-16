<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoteRepository")
 */
class Vote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true,options={"default" : 0})
     */
    private $pour;

    /**
     * @ORM\Column(type="integer", nullable=true,options={"default" : 0})
     */
    private $contre;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Idea", inversedBy="vote", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $idea;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPour(): ?int
    {
        return $this->pour;
    }

    public function setPour(?int $pour): self
    {
        $this->pour = $pour;

        return $this;
    }

    public function getContre(): ?int
    {
        return $this->contre;
    }

    public function setContre(?int $contre): self
    {
        $this->contre = $contre;

        return $this;
    }

    public function getIdea(): ?Idea
    {
        return $this->idea;
    }

    public function setIdea(Idea $idea): self
    {
        $this->idea = $idea;

        return $this;
    }
}
