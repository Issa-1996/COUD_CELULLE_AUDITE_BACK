<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FactureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=FactureRepository::class)
 */
class Facture
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
    private $numeroFacture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $object;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $beneficaire;

    /**
     * @ORM\OneToOne(targetEntity=CourierDepart::class, cascade={"persist", "remove"})
     */
    private $courierDepart;

    /**
     * @ORM\OneToOne(targetEntity=CourierArriver::class, cascade={"persist", "remove"})
     */
    private $courierArriver;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroFacture(): ?string
    {
        return $this->numeroFacture;
    }

    public function setNumeroFacture(string $numeroFacture): self
    {
        $this->numeroFacture = $numeroFacture;

        return $this;
    }

    public function getMontant(): ?string
    {
        return $this->montant;
    }

    public function setMontant(?string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getObject(): ?string
    {
        return $this->object;
    }

    public function setObject(?string $object): self
    {
        $this->object = $object;

        return $this;
    }

    public function getBeneficaire(): ?string
    {
        return $this->beneficaire;
    }

    public function setBeneficaire(?string $beneficaire): self
    {
        $this->beneficaire = $beneficaire;

        return $this;
    }

    public function getCourierDepart(): ?CourierDepart
    {
        return $this->courierDepart;
    }

    public function setCourierDepart(?CourierDepart $courierDepart): self
    {
        $this->courierDepart = $courierDepart;

        return $this;
    }

    public function getCourierArriver(): ?CourierArriver
    {
        return $this->courierArriver;
    }

    public function setCourierArriver(?CourierArriver $courierArriver): self
    {
        $this->courierArriver = $courierArriver;

        return $this;
    }
}
