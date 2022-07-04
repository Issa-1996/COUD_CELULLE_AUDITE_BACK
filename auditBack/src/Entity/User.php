<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorMap({"user" = "User", "assistante" = "Assistante", "controleurs" = "Controleurs", "coordinateur" = "Coordinateur"})
 * @UniqueEntity("username")
 * @ApiFilter(SearchFilter::class, properties={"username":"exact"})
 * @ApiResource(
 *  routePrefix="/coud",
 *     collectionOperations={"POST","GET"},
 *     itemOperations={"PUT", "GET"},
 *  normalizationContext={"groups"={"User:read"}},
 *  denormalizationContext={"groups"={"User:write"}},
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"User:read"})
     * @Groups({"User:write"})
     * @Groups({"Assistante:read"})
     * @Groups({"Controleurs:read"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Courier:read"})
     * @Groups({"Courier:write"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierDepart:write"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"CourierArriver:write"})
     * @Groups({"FicheDeControle:read"})
     * @Groups({"FicheDeControle:write"})
     * @Groups({"Profil:read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"User:read"})
     * @Groups({"User:write"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * @Groups({"Controleurs:read"})
     * @Groups({"Controleurs:write"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Coordinateur:write"})
     * @Groups({"Courier:read"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"FicheDeControle:read"})
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     * @Groups({"User:read"})
     * @Groups({"User:write"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * @Groups({"Controleurs:read"})
     * @Groups({"Controleurs:write"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Coordinateur:write"})
     * @Groups({"Courier:read"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"FicheDeControle:read"})
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"User:write"})
     * @Groups({"Assistante:write"})
     * @Groups({"Controleurs:write"})
     * @Groups({"Coordinateur:write"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true, unique=true)
     * @Groups({"User:read"})
     * @Groups({"User:write"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * @Groups({"Controleurs:read"})
     * @Groups({"Controleurs:write"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Coordinateur:write"})
     * @Groups({"Courier:read"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"FicheDeControle:read"})
     */
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"User:read"})
     * @Groups({"User:write"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * @Groups({"Controleurs:read"})
     * @Groups({"Controleurs:write"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Coordinateur:write"})
     * @Groups({"Courier:read"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"FicheDeControle:read"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"User:read"})
     * @Groups({"User:write"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * @Groups({"Controleurs:read"})
     * @Groups({"Controleurs:write"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Coordinateur:write"})
     * @Groups({"Courier:read"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"FicheDeControle:read"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"User:read"})
     * @Groups({"User:write"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * @Groups({"Controleurs:read"})
     * @Groups({"Controleurs:write"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Coordinateur:write"})
     * @Groups({"Courier:read"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"FicheDeControle:read"})
     */
    private $dateDeNaissance;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"User:read"})
     * @Groups({"User:write"})
     * @Groups({"Assistante:read"})
     * @Groups({"Assistante:write"})
     * @Groups({"Controleurs:read"})
     * @Groups({"Controleurs:write"})
     * @Groups({"Coordinateur:read"})
     * @Groups({"Coordinateur:write"})
     * @Groups({"Courier:read"})
     * @Groups({"CourierDepart:read"})
     * @Groups({"CourierArriver:read"})
     * @Groups({"FicheDeControle:read"})
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="user",cascade={"persist"})
     * @Groups({"User:read"})
     * @Groups({"User:write"})
     */
    private $profil;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->username;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }
    
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(?string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getDateDeNaissance(): ?string
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(?string $dateDeNaissance): self
    {
        $this->dateDeNaissance = $dateDeNaissance;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }
}
