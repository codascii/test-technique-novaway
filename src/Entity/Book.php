<?php
declare(strict_types=1);

namespace App\Entity;

use App\Interface\PriceInterface;
use App\Repository\BookRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
final class Book implements PriceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 10)]
    private ?string $isnb = null;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title = null;

    /**
     * @var Writer
     */
    #[ORM\ManyToOne(targetEntity: Writer::class, inversedBy: 'books')]
    private ?Writer $author = null;

    /**
     * @var \DateTimeInterface
     */
    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $publishDate = null;

    /**
     * @var integer
     */
    #[ORM\Column(type: 'integer')]
    private ?int $nbPage = null;

    /**
     * @var string
     */
    #[ORM\Column(type: 'text')]
    private ?string $summary = null;

    /**
     * @var float
     */
    #[ORM\Column(type: 'float')]
    private ?float $price = null;

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
     * @return ?int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsnb(): ?string
    {
        return $this->isnb;
    }


    /**
     * Set the value of isnb
     *
     * @param ?string $isnb
     *
     * @return self
     */
    public function setIsnb(?string $isnb): self
    {
        $this->isnb = $isnb;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }


    /**
     * Set the value of title
     *
     * @param ?string $title
     *
     * @return self
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?Writer
    {
        return $this->author;
    }


    /**
     * Set the value of author
     *
     * @param ?Writer $author
     *
     * @return self
     */
    public function setAuthor(?Writer $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getPublishDate(): ?\DateTimeInterface
    {
        return $this->publishDate;
    }


    /**
     * Set the value of publishDate
     *
     * @param ?\DateTimeInterface $publishDate
     *
     * @return self
     */
    public function setPublishDate(?\DateTimeInterface $publishDate): self
    {
        $this->publishDate = $publishDate;

        return $this;
    }

    public function getNbPage(): ?int
    {
        return $this->nbPage;
    }


    /**
     * Set the value of nbPage
     *
     * @param ?int $nbPage
     *
     * @return self
     */
    public function setNbPage(?int $nbPage): self
    {
        $this->nbPage = $nbPage;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }


    /**
     * Set the value of summary
     *
     * @param ?string $summary
     *
     * @return self
     */
    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

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

    public function getMedia(): ?string
    {
        return 'book';
    }
}
