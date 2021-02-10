<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\SeanceRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=SeanceRepository::class)
 */
class Seance
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * 
     * @ORM\Column(type="datetime")
     * @Groups("read")
     */
    private $dateSeance;

    /**
     * 
     * @ORM\ManyToOne(targetEntity=Film::class, inversedBy="seances")
     */
    private $film;

    /**
     * 
     * @ORM\ManyToOne(targetEntity=Salle::class, inversedBy="seances")
     * @Groups("read")
     */
    private $salle;

    public function getDateSeance(): ?DateTime
    {
        return $this->dateSeance;
    }

    public function setDateSeance(DateTime $dateSeance): self
    {
        $this->dateSeance = $dateSeance;

        return $this;
    }

    public function getFilm(): ?Film
    {
        return $this->film;
    }

    public function setFilm(?Film $film): self
    {
        $this->film = $film;

        return $this;
    }

    public function getSalle(): ?Salle
    {
        return $this->salle;
    }

    public function setSalle(?Salle $salle): self
    {
        $this->salle = $salle;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
}
