<?php

namespace App\Tests\Entity;

use App\Entity\Actor;
use App\Entity\BluRay;
use PHPUnit\Framework\TestCase;

final class BluRayTest  extends TestCase
{
    public function testBluRayClass()
    {        
        $id = 62;
        $asin = "B07BZC5KHW";
        $title = "Avengers Infinity war";
        $releaseDate = new \DateTimeImmutable();
        $duration = 149;
        $summary = "lorem";
        $price = 49.99;
        $cast = [
            new Actor("Chris", "Hemsworth"),
            new Actor("Robert", "Downey")
        ];

        $bluRay = new BluRay($id, $asin, $title, $releaseDate, $duration, $summary, $price, $cast);
                
        $this->assertEquals($id, $bluRay->getId());
        $this->assertEquals($asin, $bluRay->getAsin());
        $this->assertEquals($title, $bluRay->getTitle());
        $this->assertEquals($releaseDate, $bluRay->getReleaseDate());
        $this->assertEquals($duration, $bluRay->getDuration());
        $this->assertEquals($summary, $bluRay->getSummary());
        $this->assertEquals($price, $bluRay->getPrice());
        $this->assertEquals("BluRay", $bluRay->getMedia());
    }
}
