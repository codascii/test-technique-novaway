<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
final class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Column(type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 254, unique: true)]
    #[Assert\NotBlank(message: "L'adresse email est obligatoire.")]
    #[Assert\Email(message: "L'adresse email {{ value }} n'est pas valide")]
    #[Assert\Unique]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 64)]
    #[Assert\NotBlank(message: "Le mot de passe est obligatoire.")]
    #[Assert\Length(min: 8, minMessage: "Le mot de passe doit avoir au moins 8 caractères.")]
    private ?string $password = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: "L'adresse de l'utilisateur est obligatoire.")]
    #[Assert\Length(min: 10, minMessage: "L'adresse de l'utilisateur doit avoir au moins 10 caractères.")]
    private ?string $street = null;

    #[ORM\Column(type: 'string', length: 6)]
    #[Assert\NotBlank(message: "Le code postale de l'utilisateur est obligatoire.")]
    #[Assert\Length(exactly: 5, exactMessage: "Le code postale de l'utilisateur doit avoir exactement 5 caractères.")]
    private ?string $zipcode = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: "La ville de l'utilisateur est obligatoire.")]
    #[Assert\Length(min: 2, minMessage: "La ville de l'utilisateur doit avoir au moins 2 caractères.")]
    private ?string $city = null;

    public function getUsername(): ?string
    {
        return $this->getEmail();
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return ?string
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }


    /**
     * Set the value of street
     *
     * @param ?string $street
     *
     * @return self
     */
    public function setStreet(?string $street): self
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return ?string
     */
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }


    /**
     * Set the value of zipcode
     *
     * @param ?string $zipcode
     *
     * @return self
     */
    public function setZipcode(?string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * @return ?string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }


    /**
     * Set the value of city
     *
     * @param ?string $city
     *
     * @return self
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getSalt()
    {
        return 'unPetitGrainDeSel';
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return \serialize([
            $this->id,
            $this->email,
            $this->password,
        ]);
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->password,
            ) = \unserialize($serialized, ['allowed_classes' => false]);
    }
}
