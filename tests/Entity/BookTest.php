<?php

namespace App\Tests\Entity;

use App\Entity\Book;
use App\Entity\Writer;
use PHPUnit\Framework\TestCase;

final class BookTest  extends TestCase
{
    public function testBookClass()
    {        
        $isnb = "0307887898";
        $title = "The Lean Startup";
        $author = new Writer("Mohamed", "HOUMADI");
        $publishDate = new \DateTimeImmutable();
        $nbPage = 160;
        $summary = "lorem";
        $price = 49.99;

        $book = new Book($isnb, $title, $author, $publishDate, $nbPage, $summary, $price);
                
        $this->assertEquals($isnb, $book->getIsnb());
        $this->assertEquals($title, $book->getTitle());
        $this->assertEquals($publishDate, $book->getPublishDate());
        $this->assertEquals($nbPage, $book->getNbPage());
        $this->assertEquals($summary, $book->getSummary());
        $this->assertEquals($price, $book->getPrice());
        $this->assertEquals("book", $book->getMedia());
    }
}
