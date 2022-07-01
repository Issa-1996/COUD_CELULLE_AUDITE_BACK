<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FicheDeControleRepository;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  routePrefix="/coud",
 *     collectionOperations={"POST","GET"},
 *     itemOperations={"PUT", "GET"},
 *  normalizationContext={"groups"={"FicheDeControle:read"}},
 *  denormalizationContext={"groups"={"FicheDeControle:write"}},
 * )
 * @ORM\Entity(repositoryClass=FicheDeControleRepository::class)
 */
class FicheDeControle
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"User:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"User:read"})
     */
    private $nomControleur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"User:read"})
     */
    private $avisControleur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"User:read"})
     */
    private $motivation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"User:read"})
     */
    private $recommandations;

    /**
     * @ORM\ManyToOne(targetEntity=Controleurs::class, inversedBy="FicheDeControle")
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     */
    private $controleurs;

    /**
     * @ORM\ManyToOne(targetEntity=Coordinateur::class, inversedBy="FicheDeControle")
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     */
    private $coordinateur;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"User:read"})
     */
    private $objet;

    /**
     * @ORM\OneToOne(targetEntity=CourierArriver::class, inversedBy="ficheDeControle", cascade={"persist", "remove"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"Controleurs:read"})
     * @Groups({"User:read"})
     */
    private $courrierArriver;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomControleur(): ?string
    {
        return $this->nomControleur;
    }

    public function setNomControleur(string $nomControleur): self
    {
        $this->nomControleur = $nomControleur;

        return $this;
    }

    public function getAvisControleur(): ?string
    {
        return $this->avisControleur;
    }

    public function setAvisControleur(?string $avisControleur): self
    {
        $this->avisControleur = $avisControleur;

        return $this;
    }

    public function getMotivation(): ?string
    {
        return $this->motivation;
    }

    public function setMotivation(?string $motivation): self
    {
        $this->motivation = $motivation;

        return $this;
    }

    public function getRecommandations(): ?string
    {
        return $this->recommandations;
    }

    public function setRecommandations(string $recommandations): self
    {
        $this->recommandations = $recommandations;

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

    public function getCoordinateur(): ?Coordinateur
    {
        return $this->coordinateur;
    }

    public function setCoordinateur(?Coordinateur $coordinateur): self
    {
        $this->coordinateur = $coordinateur;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getCourrierArriver(): ?CourierArriver
    {
        return $this->courrierArriver;
    }

    public function setCourrierArriver(?CourierArriver $courrierArriver): self
    {
        $this->courrierArriver = $courrierArriver;

        return $this;
    }
}
