<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CourierRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  routePrefix="/coud",
 *  attributes={
 *         "security"="is_granted('ROLE_ADMIN')", 
 *         "security_message"="Vous n'avez pas access à cette Ressource",
 *     },
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
     */
    private $assistante;

    /**
     * @ORM\ManyToOne(targetEntity=Coordinateur::class, inversedBy="courier")
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
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
