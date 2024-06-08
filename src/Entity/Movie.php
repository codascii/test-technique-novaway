<?php
declare(strict_types=1);

namespace App\Entity;

use App\Interface\PriceInterface;
use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "discriminator", type: "string")]
#[ORM\DiscriminatorMap(["dvd" => "Dvd", "br" => "BluRay"])]
#[ORM\Entity(repositoryClass: MovieRepository::class)]
abstract class Movie implements PriceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 10)]
    private ?string $asin = null;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private ?string $title = null;

    /**
     * @var Director
     */
    #[ORM\ManyToOne(targetEntity: Director::class, inversedBy: 'movies')]
    private ?Director $director = null;

    /**
     * @var \Doctrine\Common\Collections\Collection|Actor[]
     */
    #[ORM\ManyToMany(targetEntity: Actor::class, cascade: ['persist'], fetch: 'EAGER')]
    private $cast;

    /**
     * @var \DateTimeInterface
     */
    #[ORM\Column(type: 'date')]
    private ?\DateTimeInterface $releaseDate = null;

    /**
     * @var integer
     */
    #[ORM\Column(type: 'integer')]
    private ?int $duration = null;

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
     * Movie constructor.
     * @param int $id
     */
    public function __construct(int $id, string $asin, string $title, \DateTimeInterface $releaseDate, int $duration, string $summary, float $price, array $cast)
    {
        $this->id = $id;
        $this->asin = $asin;
        $this->title = $title;
        $this->releaseDate = $releaseDate;
        $this->duration = $duration;
        $this->summary = $summary;
        $this->price = $price;
        $this->cast = new ArrayCollection($cast);
    }

    /**
     * @return int
     */
    public function getId() :int
    {
        return $this->id;
    }

    public function getAsin(): string
    {
        return $this->asin;
    }


    /**
     * Set the value of asin
     *
     * @param ?string $asin
     *
     * @return self
     */
    public function setAsin(?string $asin): self
    {
        $this->asin = $asin;

        return $this;
    }

    public function getTitle(): string
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

    public function getDirector(): ?Director
    {
        return $this->director;
    }


    /**
     * Set the value of director
     *
     * @param ?Director $director
     *
     * @return self
     */
    public function setDirector(?Director $director): self
    {
        $this->director = $director;

        return $this;
    }

    /**
     * @return Actor[]|\Doctrine\Common\Collections\Collection
     */
    public function getCast()
    {
        return $this->cast;
    }

    public function getReleaseDate(): \DateTimeInterface
    {
        return $this->releaseDate;
    }


    /**
     * Set the value of releaseDate
     *
     * @param ?\DateTimeInterface $releaseDate
     *
     * @return self
     */
    public function setReleaseDate(?\DateTimeInterface $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }


    /**
     * Set the value of duration
     *
     * @param ?int $duration
     *
     * @return self
     */
    public function setDuration(?int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function getSummary(): string
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

    public function getPrice(): float
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

    abstract public function getMedia(): string;
}
