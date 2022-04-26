<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CourierArriverRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CourierArriverRepository::class)
 */
class CourierArriver extends Courier
{

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dateArriver;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $expediteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dateCorrespondance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroCorrespondance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dateReponse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $numeroReponse;


    public function getDateArriver(): ?string
    {
        return $this->dateArriver;
    }

    public function setDateArriver(?string $dateArriver): self
    {
        $this->dateArriver = $dateArriver;

        return $this;
    }

    public function getExpediteur(): ?string
    {
        return $this->expediteur;
    }

    public function setExpediteur(?string $expediteur): self
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    public function getDateCorrespondance(): ?string
    {
        return $this->dateCorrespondance;
    }

    public function setDateCorrespondance(?string $dateCorrespondance): self
    {
        $this->dateCorrespondance = $dateCorrespondance;

        return $this;
    }

    public function getNumeroCorrespondance(): ?string
    {
        return $this->numeroCorrespondance;
    }

    public function setNumeroCorrespondance(?string $numeroCorrespondance): self
    {
        $this->numeroCorrespondance = $numeroCorrespondance;

        return $this;
    }

    public function getDateReponse(): ?string
    {
        return $this->dateReponse;
    }

    public function setDateReponse(?string $dateReponse): self
    {
        $this->dateReponse = $dateReponse;

        return $this;
    }

    public function getNumeroReponse(): ?string
    {
        return $this->numeroReponse;
    }

    public function setNumeroReponse(?string $numeroReponse): self
    {
        $this->numeroReponse = $numeroReponse;

        return $this;
    }
}
