<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
final class User implements PasswordAuthenticatedUserInterface, UserInterface
{
    #[ORM\Column(type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 254, unique: true)]
    private ?string $email = null;

    #[ORM\Column(type: 'string', length: 64)]
    private ?string $password = null;

    #[ORM\Column(type: 'string')]
    private ?string $street = null;

    #[ORM\Column(type: 'string', length: 6)]
    private ?string $zipcode = null;

    #[ORM\Column(type: 'string')]
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

    public function __serialize(): array
    {
        return [
          'id' => $this->id,
          'email' => $this->email,
          'password' => $this->password,
          'street' => $this->street,
          'zipcode' => $this->zipcode,
          'city' => $this->city,
        ];
    }

    public function __unserialize(array $data): void
    {
        // Pour chaque champ du tableau $data
        // On set la valeur s'il existe un setter dans la classe
        foreach($data as $key => $value) {
            $method = 'set' . \ucfirst($key);

            if (\method_exists(self::class, $method)) {
                $this->$method($value);
            }
        }
    }
}
