<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CourierDepartRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  routePrefix="/coud",
 *     attributes={"pagination_items_per_page"=100000000},
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
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * 
     */
    private $observation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * 
     */
    private $type;

    /**
     * @ORM\Column(type="string")
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * 
     */
    private $dateDepart;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * 
     */
    private $numeroDepart;

    public function getObservation(): ?string
    {
        return $this->observation;
    }

    public function setObservation(?string $observation): self
    {
        $this->observation = $observation;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateDepart(): ?string
    {
        return $this->dateDepart;
    }

    public function setDateDepart(string $dateDepart): self
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    public function getNumeroDepart(): ?string
    {
        return $this->numeroDepart;
    }

    public function setNumeroDepart(string $numeroDepart): self
    {
        $this->numeroDepart = $numeroDepart;

        return $this;
    }
}
