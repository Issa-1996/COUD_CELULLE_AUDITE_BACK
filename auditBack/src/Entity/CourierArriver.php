<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CourierArriverRepository;
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
 *  normalizationContext={"groups"={"CourierArriver:read"}},
 *  denormalizationContext={"groups"={"CourierArriver:write"}},
 * )
 * @ORM\Entity(repositoryClass=CourierArriverRepository::class)
 */
class CourierArriver extends Courier
{

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"Facture:read"})
     */
    private $dateArriver;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"Facture:read"})
     */
    private $expediteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"Facture:read"})
     */
    private $dateCorrespondance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"Facture:read"})
     */
    private $numeroCorrespondance;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"Facture:read"})
     */
    private $dateReponse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"Facture:read"})
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