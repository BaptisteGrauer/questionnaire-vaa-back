<?php

namespace App\Entity;

use App\Repository\ReponseRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReponseRepository::class)]
class Reponse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $q1 = null;

    #[ORM\Column]
    private ?int $q2 = null;

    #[ORM\Column]
    private ?int $q3 = null;

    #[ORM\Column]
    private ?int $q4 = null;

    #[ORM\Column]
    private ?int $q5 = null;

    #[ORM\Column]
    private ?int $q6 = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQ1(): ?int
    {
        return $this->q1;
    }

    public function setQ1(int $q1): static
    {
        $this->q1 = $q1;

        return $this;
    }

    public function getQ2(): ?int
    {
        return $this->q2;
    }

    public function setQ2(int $q2): static
    {
        $this->q2 = $q2;

        return $this;
    }

    public function getQ3(): ?int
    {
        return $this->q3;
    }

    public function setQ3(int $q3): static
    {
        $this->q3 = $q3;

        return $this;
    }

    public function getQ4(): ?int
    {
        return $this->q4;
    }

    public function setQ4(int $q4): static
    {
        $this->q4 = $q4;

        return $this;
    }

    public function getQ5(): ?int
    {
        return $this->q5;
    }

    public function setQ5(int $q5): static
    {
        $this->q5 = $q5;

        return $this;
    }

    public function getQ6(): ?int
    {
        return $this->q6;
    }

    public function setQ6(int $q6): static
    {
        $this->q6 = $q6;

        return $this;
    }
}
