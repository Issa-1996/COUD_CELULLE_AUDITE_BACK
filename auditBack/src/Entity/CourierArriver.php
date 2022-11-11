<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CourierArriverRepository;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  routePrefix="/coud",
 *     attributes={"pagination_items_per_page"=100000000},
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
     * @Groups({"User:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"Assistante:read"})
     */
    private $expediteur;

    /**
     * @ORM\OneToOne(targetEntity=FicheDeControle::class, mappedBy="courrierArriver", cascade={"persist", "remove"})
     * @ApiSubresource()
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"User:read"})
     * @Groups({"Assistante:read"})
     */
    private $ficheDeControle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"User:read"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"Assistante:read"})
     */
    private $etat;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"User:read"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"Assistante:read"})
     */
    private $statut;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"User:read"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"Assistante:read"})
     */
    private $typeDeCourrier;

    /**
     * @ORM\Column(type="string")
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"User:read"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"Assistante:read"})
     */
    private $dateArriver;

    /**
     * @ORM\Column(type="string", length=255 , unique=true))
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"User:read"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"Assistante:read"})
     */
    private $numeroArriver;


    public function getExpediteur(): ?string
    {
        return $this->expediteur;
    }

    public function setExpediteur(?string $expediteur): self
    {
        $this->expediteur = $expediteur;

        return $this;
    }

    public function getFicheDeControle(): ?FicheDeControle
    {
        return $this->ficheDeControle;
    }

    public function setFicheDeControle(?FicheDeControle $ficheDeControle): self
    {
        // unset the owning side of the relation if necessary
        if ($ficheDeControle === null && $this->ficheDeControle !== null) {
            $this->ficheDeControle->setCourrierArriver(null);
        }

        // set the owning side of the relation if necessary
        if ($ficheDeControle !== null && $ficheDeControle->getCourrierArriver() !== $this) {
            $ficheDeControle->setCourrierArriver($this);
        }

        $this->ficheDeControle = $ficheDeControle;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(?string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getTypeDeCourrier(): ?string
    {
        return $this->typeDeCourrier;
    }

    public function setTypeDeCourrier(?string $typeDeCourrier): self
    {
        $this->typeDeCourrier = $typeDeCourrier;

        return $this;
    }

    public function getDateArriver(): ?string
    {
        return $this->dateArriver;
    }

    public function setDateArriver(string $dateArriver): self
    {
        $this->dateArriver = $dateArriver;

        return $this;
    }

    public function getNumeroArriver(): ?string
    {
        return $this->numeroArriver;
    }

    public function setNumeroArriver(string $numeroArriver): self
    {
        $this->numeroArriver = $numeroArriver;

        return $this;
    }
}
