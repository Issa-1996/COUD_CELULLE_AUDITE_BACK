<?php

namespace App\Entity;

use App\Entity\Assistante;
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
 * @ApiResource(
 * attributes={"pagination_items_per_page"=100000000},
 *  routePrefix="/coud",
 *     collectionOperations={"POST","GET"},
 *     itemOperations={"PUT", "GET"},
 *  normalizationContext={"groups"={"CourierDepart:read"}},
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
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"User:read"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"Controleurs:read"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
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
     * @Groups({"User:read"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
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
     * @Groups({"User:read"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     */
    private $object;

    /**
     * @ORM\ManyToOne(targetEntity=Assistante::class, inversedBy="courier")
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Controleurs:read"})
     * @Groups({"Coordinateur:read"})
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
     * @Groups({"Controleurs:read"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * @Groups({"User:read"})
     */
    private $coordinateur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"User:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     */
    private $NumeroFacture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"User:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     */
    private $montant;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"User:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     */
    private $destinataire;

    /**
     * @ORM\ManyToOne(targetEntity=Controleurs::class, inversedBy="courrier")
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"User:read"})
     */
    private $controleurs;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"User:read"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     */
    private $numeroCompte;


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

    public function getNumeroFacture(): ?string
    {
        return $this->NumeroFacture;
    }

    public function setNumeroFacture(string $NumeroFacture): self
    {
        $this->NumeroFacture = $NumeroFacture;

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

    public function getDestinataire(): ?string
    {
        return $this->destinataire;
    }

    public function setDestinataire(?string $destinataire): self
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    public function getControleurs(): ?Controleurs
    {
        return $this->controleurs;
    }

    public function setControleurs(?Controleurs $controleurs): self
    {
        $this->controleurs = $controleurs;

        return $this;
    }

    public function getNumeroCompte(): ?string
    {
        return $this->numeroCompte;
    }

    public function setNumeroCompte(?string $numeroCompte): self
    {
        $this->numeroCompte = $numeroCompte;

        return $this;
    }
}
