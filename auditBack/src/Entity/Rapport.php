<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RapportRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  routePrefix="/coud",
 *     collectionOperations={
 *          "POST"={
 *              "security"="is_granted('ROLE_COORDINATEUR', 'ROLE_SUPERADMIN')", 
 *              "security_message"="Vous n'avez pas access à cette Ressource",
 *          },"GET"},
 *     itemOperations={
 *          "PUT"={
 *              "security"="is_granted('ROLE_COORDINATEUR', 'ROLE_SUPERADMIN')", 
 *              "security_message"="Vous n'avez pas access à cette Ressource",
 *          }, "GET"},
 *  normalizationContext={"groups"={"Rapport:read"}},
 *  denormalizationContext={"groups"={"Rapport:write"}},
 * )
 * @ORM\Entity(repositoryClass=RapportRepository::class)
 */
class Rapport
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"Rapport:read"})
     * @Groups({"Rapport:write"})
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"Rapport:read"})
     * @Groups({"Rapport:write"})
     * @Groups({"Courier:read"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierArriver:read"})
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Courier::class, mappedBy="rapport")
     * @ApiSubresource()
     * @Groups({"Rapport:read"})
     * @Groups({"Rapport:write"})
     */
    private $courier;

    /**
     * @ORM\ManyToOne(targetEntity=Coordinateur::class, inversedBy="rapports",cascade={"persist"})
     * @Groups({"Rapport:read"})
     * @Groups({"Rapport:write"})
     */
    private $coordinateur;

    public function __construct()
    {
        $this->courier = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

    /**
     * @return Collection<int, Courier>
     */
    public function getCourier(): Collection
    {
        return $this->courier;
    }

    public function addCourier(Courier $courier): self
    {
        if (!$this->courier->contains($courier)) {
            $this->courier[] = $courier;
            $courier->setRapport($this);
        }

        return $this;
    }

    public function removeCourier(Courier $courier): self
    {
        if ($this->courier->removeElement($courier)) {
            // set the owning side to null (unless already changed)
            if ($courier->getRapport() === $this) {
                $courier->setRapport(null);
            }
        }

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
