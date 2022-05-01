<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\FicheDeControleRepository;
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
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     */
    private $nomControleur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     */
    private $avisControleur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     */
    private $motivation;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
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
}
