<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
final class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 10)]
    private $isnb;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    /**
     * @var Writer
     */
    #[ORM\ManyToOne(targetEntity: Writer::class, inversedBy: 'books')]
    private $author;

    /**
     * @var \DateTimeInterface
     */
    #[ORM\Column(type: 'date')]
    private $publishDate;

    /**
     * @var integer
     */
    #[ORM\Column(type: 'integer')]
    private $nbPage;

    /**
     * @var string
     */
    #[ORM\Column(type: 'text')]
    private $summary;

    /**
     * @var float
     */
    #[ORM\Column(type: 'float')]
    private $price;

    /**
     * Book constructor.
     */
    public function __construct(string $isnb, string $title, Writer $author, \DateTimeInterface $publishDate, int $nbPage, string $summary, float $price)
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

    public function getIsnb(): string
    {
        return $this->isnb;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthor(): ?Writer
    {
        return $this->author;
    }

    /**
     * Set the value of author
     */
    public function setAuthor(?Writer $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getPublishDate(): \DateTimeInterface
    {
        return $this->publishDate;
    }

    public function getNbPage(): int
    {
        return $this->nbPage;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getMedia(): string
    {
        return 'book';
    }
}
