<?php

namespace App\Entity;

use App\Entity\Rapport;
use App\Entity\Assistante;
use App\Entity\Controleurs;
use App\Entity\Coordinateur;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CourierRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiFilter(SearchFilter::class, properties={"nature":"exact"})
 * @ApiResource(
 *  routePrefix="/coud",
 *     collectionOperations={"POST","GET"},
 *     itemOperations={"PUT", "GET"},
 *  normalizationContext={"groups"={"Courier:read"}},
 *  denormalizationContext={"groups"={"Courier:write"}},
 * )
 * @ORM\Entity(repositoryClass=CourierRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorMap({"courier" = "Courier","courierDepart" = "CourierDepart", "courierArriver" = "CourierArriver"})
 */
class Courier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"Courier:read"})
     * @Groups({"Rapport:read"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierDepart:read"}) 
     * @Groups({"Rapport:read"})
     * @Groups({"Rapport:write"})
     * @Groups({"Facture:read"})
     * @Groups({"Facture:write"})
     * @Groups({"User:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Rapport:read"})
     * @Groups({"User:read"})
     */
    private $numeroCourier;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Rapport:read"})
     * @Groups({"User:read"})
     */
    private $object;

    /**
     * @ORM\ManyToMany(targetEntity=Controleurs::class, inversedBy="couriers")
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Rapport:read"})
     */
    private $controleurs;

    /**
     * @ORM\ManyToOne(targetEntity=Rapport::class, inversedBy="courier")
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     */
    private $rapport;

    /**
     * @ORM\ManyToOne(targetEntity=Assistante::class, inversedBy="courier")
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Rapport:read"})
     */
    private $assistante;

    /**
     * @ORM\ManyToOne(targetEntity=Coordinateur::class, inversedBy="courier",cascade={"persist"})
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Rapport:read"})
     */
    private $coordinateur;

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

    public function getCoordinateur(): ?Coordinateur
    {
        return $this->coordinateur;
    }

    public function setCoordinateur(?Coordinateur $coordinateur): self
    {
        $this->coordinateur = $coordinateur;

        return $this;
    }
}
