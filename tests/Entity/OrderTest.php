<?php

namespace App\Tests\Entity;

use App\Entity\Actor;
use App\Entity\Book;
use App\Entity\Dvd;
use App\Entity\Order;
use App\Entity\Writer;
use PHPUnit\Framework\TestCase;

final class OrderTest  extends TestCase
{
    public function testOrderClass()
    {
        // Instance d'un livre
        $isnb = "0307887898";
        $title = "The Lean Startup";
        $author = new Writer("Mohamed", "HOUMADI");
        $publishDate = new \DateTimeImmutable();
        $nbPage = 160;
        $summary = "lorem";
        $price = 49.99;
        $book = new Book($isnb, $title, $author, $publishDate, $nbPage, $summary, $price);

        // Instance d'un DVD
        $cast = [new Actor("Chris", "Hemsworth"), new Actor("Robert", "Downey")];
        $blackPantherDVD = new Dvd(2, "B079FLYB41", "Black Panther", new \DateTimeImmutable(), 134, "lorem", 16.99, $cast);

        $deliveryStreet = 62;
        $deliveryZipcode = "B07BZC5KHW";
        $deliveryCity = "Avengers Infinity war";
        $price = 120.63;
        $cart = [
            "B079FLYB41" => [
                "item" => $blackPantherDVD,
                "qty" => 4
            ],
            "0307887898" => [
                "item" => $book,
                "qty" => 1
            ]
        ];

        $order = new Order($deliveryStreet, $deliveryZipcode, $deliveryCity, $cart, $price);
                
        $this->assertEquals($deliveryStreet, $order->getDeliveryStreet());
        $this->assertEquals($deliveryZipcode, $order->getDeliveryZipcode());
        $this->assertEquals($deliveryCity, $order->getDeliveryCity());
        $this->assertEquals($price, $order->getPrice());
    }
}
