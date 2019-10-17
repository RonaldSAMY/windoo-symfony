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

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function __toString()
    {
        return (string) $this->id;
    }
}
