<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=10)
     */
    private $isnb;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var Writer
     * @ORM\ManyToOne(targetEntity="App\Entity\Writer", inversedBy="books")
     */
    private $author;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="date")
     */
    private $publishDate;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $nbPage;

    /**
     * @var string
     * @ORM\Column(type="text")
     */
    private $summary;

    /**
     * @var float
     * @ORM\Column(type="float")
     */
    private $price;

    /**
     * Book constructor.
     * @param string $isnb
     * @param string $title
     * @param Individual $author
     * @param \DateTimeInterface $publishDate
     * @param int $nbPage
     * @param string $summary
     * @param float $price
     */
    public function __construct(string $isnb, string $title, Individual $author, \DateTimeInterface $publishDate, int $nbPage, string $summary, float $price)
    {
        $this->isnb = $isnb;
        $this->title = $title;
        $this->author = $author;
        $this->publishDate = $publishDate;
        $this->nbPage = $nbPage;
        $this->summary = $summary;
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getIsnb(): string
    {
        return $this->isnb;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return Individual
     */
    public function getAuthor(): Individual
    {
        return $this->author;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getPublishDate(): \DateTimeInterface
    {
        return $this->publishDate;
    }

    /**
     * @return int
     */
    public function getNbPage(): int
    {
        return $this->nbPage;
    }

    /**
     * @return string
     */
    public function getSummary(): string
    {
        return $this->summary;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getMedia(): string
    {
        return 'book';
    }
}
