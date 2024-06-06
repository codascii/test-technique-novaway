<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="purchase_oder")
 */
#[ORM\Entity(repositoryClass: OrderRepository::class)]
final class Order
{
    #[ORM\Column(type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    private $id;

    #[ORM\Column(type: 'string')]
    private $deliveryStreet;
    #[ORM\Column(type: 'string')]
    private $deliveryZipcode;
    #[ORM\Column(type: 'string')]
    private $deliveryCity;
    #[ORM\Column(type: 'string')]
    private $cart;

    #[ORM\Column(type: 'float')]
    private $price;

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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getDeliveryStreet(): string
    {
        return $this->deliveryStreet;
    }

    public function getDeliveryZipcode(): string
    {
        return $this->deliveryZipcode;
    }

    public function getDeliveryCity(): string
    {
        return $this->deliveryCity;
    }

    public function getCart(): array
    {
        return \json_decode($this->cart, true);
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }
}
