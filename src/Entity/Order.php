<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Table(name: 'purchase_oder')]
#[ORM\Entity(repositoryClass: OrderRepository::class)]
final class Order
{
    #[ORM\Column(type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: "L'adresse de livraison est obligatoire.")]
    #[Assert\Length(min: 5, minMessage: "L'adresse de livraison doit avoir au moins 5 caractères.")]
    private ?string $deliveryStreet = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: "Le code postal est obligatoire.")]
    #[Assert\Length(exactly: 5, exactMessage: "Le code postal doit avoir exactement 5 caractères.")]
    private ?string $deliveryZipcode = null;

    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: "La ville de livraison est obligatoire.")]
    #[Assert\Length(min: 2, minMessage: "La ville de livraison doit avoir au moins 2 caractères.")]
    private ?string $deliveryCity = null;
    
    #[ORM\Column(type: 'string')]
    #[Assert\NotBlank(message: "Le panier de la commande est obligatoire.")]
    #[Assert\Json(message: "La panier doit être un objet json valid.")]
    private ?string $cart = null;

    #[ORM\Column(type: 'float')]
    #[Assert\Positive(message: "Le prix doit être positif.")]
    private ?float $price = null;

    /**
     * Order constructor.
     */
    public function __construct(string $deliveryStreet, string $deliveryZipcode, string $deliveryCity, array $cart, float $price)
    {
        $this->deliveryStreet = $deliveryStreet;
        $this->deliveryZipcode = $deliveryZipcode;
        $this->deliveryCity = $deliveryCity;
        $this->cart = \json_encode($cart);
        $this->price = $price;
    }

    /**
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeliveryStreet(): string
    {
        return $this->deliveryStreet;
    }


    /**
     * Set the value of deliveryStreet
     *
     * @param ?string $deliveryStreet
     *
     * @return self
     */
    public function setDeliveryStreet(?string $deliveryStreet): self
    {
        $this->deliveryStreet = $deliveryStreet;

        return $this;
    }

    public function getDeliveryZipcode(): ?string
    {
        return $this->deliveryZipcode;
    }


    /**
     * Set the value of deliveryZipcode
     *
     * @param ?string $deliveryZipcode
     *
     * @return self
     */
    public function setDeliveryZipcode(?string $deliveryZipcode): self
    {
        $this->deliveryZipcode = $deliveryZipcode;

        return $this;
    }

    public function getDeliveryCity(): ?string
    {
        return $this->deliveryCity;
    }


    /**
     * Set the value of deliveryCity
     *
     * @param ?string $deliveryCity
     *
     * @return self
     */
    public function setDeliveryCity(?string $deliveryCity): self
    {
        $this->deliveryCity = $deliveryCity;

        return $this;
    }

    public function getCart(): array
    {
        return \json_decode($this->cart, true);
    }


    /**
     * Set the value of cart
     *
     * @param ?string $cart
     *
     * @return self
     */
    public function setCart(?string $cart): self
    {
        $this->cart = $cart;

        return $this;
    }

    /**
     * @return ?float
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }


    /**
     * Set the value of price
     *
     * @param ?float $price
     *
     * @return self
     */
    public function setPrice(?float $price): self
    {
        $this->price = $price;

        return $this;
    }
}
