<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CourierRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass=CourierRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorMap({"courierDepart" = "CourierDepart", "courierArriver" = "CourierArriver"})
 */
class Courier
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
    private $numeroCourier;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $object;

    /**
     * @ORM\ManyToMany(targetEntity=Controleurs::class, inversedBy="couriers")
     */
    private $controleurs;

    /**
     * @ORM\ManyToOne(targetEntity=Rapport::class, inversedBy="courier")
     */
    private $rapport;

    /**
     * @ORM\ManyToOne(targetEntity=Assistante::class, inversedBy="courier")
     */
    private $assistante;

    public function __construct()
    {
        $this->controleurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroCourier(): ?string
    {
        return $this->numeroCourier;
    }

    public function setNumeroCourier(string $numeroCourier): self
    {
        $this->numeroCourier = $numeroCourier;

        return $this;
    }

    public function getObject(): ?string
    {
        return $this->object;
    }

    public function setObject(string $object): self
    {
        $this->object = $object;

        return $this;
    }

    /**
     * @return Collection<int, Controleurs>
     */
    public function getControleurs(): Collection
    {
        return $this->controleurs;
    }

    public function addControleur(Controleurs $controleur): self
    {
        if (!$this->controleurs->contains($controleur)) {
            $this->controleurs[] = $controleur;
        }

        return $this;
    }

    public function removeControleur(Controleurs $controleur): self
    {
        $this->controleurs->removeElement($controleur);

        return $this;
    }

    public function getRapport(): ?Rapport
    {
        return $this->rapport;
    }

    public function setRapport(?Rapport $rapport): self
    {
        $this->rapport = $rapport;

        return $this;
    }

    public function getAssistante(): ?Assistante
    {
        return $this->assistante;
    }

    public function setAssistante(?Assistante $assistante): self
    {
        $this->assistante = $assistante;

        return $this;
    }
}
