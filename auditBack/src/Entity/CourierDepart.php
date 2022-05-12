<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CourierDepartRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  routePrefix="/coud",
 *     collectionOperations={"POST","GET"},
 *     itemOperations={"PUT", "GET"},
 *  normalizationContext={"groups"={"CourierDepart:read"}},
 *  denormalizationContext={"groups"={"CourierDepart:write"}},
 * )
 * @ORM\Entity(repositoryClass=CourierDepartRepository::class)
 */
class CourierDepart extends Courier
{

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Facture:read"})
     * @Groups({"Rapport:read"})
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Facture:read"})
     * @Groups({"Rapport:read"})
     */
    private $destination;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Facture:read"})
     * @Groups({"Rapport:read"})
     */
    private $nombrePiece;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Facture:read"})
     * @Groups({"Rapport:read"})
     */
    private $numeroArchive;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Facture:read"})
     * @Groups({"Rapport:read"})
     */
    private $observation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Facture:read"})
     * @Groups({"Rapport:read"})
     */
    private $numeroOrdre;


    public function getDateDepart(): ?string
    {
        return $this->dateDepart;
    }

    public function setDateDepart(?string $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(?string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getNombrePiece(): ?string
    {
        return $this->nombrePiece;
    }

    public function setNombrePiece(string $nombrePiece): self
    {
        $this->nombrePiece = $nombrePiece;

        return $this;
    }

    public function getNumeroArchive(): ?string
    {
        return $this->numeroArchive;
    }

    public function setNumeroArchive(?string $numeroArchive): self
    {
        $this->numeroArchive = $numeroArchive;

        return $this;
    }

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getNumeroOrdre(): ?string
    {
        return $this->numeroOrdre;
    }

    public function setNumeroOrdre(?string $numeroOrdre): self
    {
        $this->numeroOrdre = $numeroOrdre;

        return $this;
    }
}
