<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\MovieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "discriminator", type: "string")]
#[ORM\DiscriminatorMap(["dvd" => "Dvd", "br" => "BluRay"])]
#[ORM\Entity(repositoryClass: MovieRepository::class)]
abstract class Movie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 10)]
    private $asin;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    /**
     * @var Director
     */
    #[ORM\ManyToOne(targetEntity: Director::class, inversedBy: 'movies')]
    private $director;

    /**
     * @var \Doctrine\Common\Collections\Collection|Actor[]
     */
    #[ORM\ManyToMany(targetEntity: Actor::class, cascade: ['persist'], fetch: 'EAGER')]
    private $cast;

    /**
     * @var \DateTimeInterface
     */
    #[ORM\Column(type: 'date')]
    private $releaseDate;

    /**
     * @var integer
     */
    #[ORM\Column(type: 'integer')]
    private $duration;

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
     * Movie constructor.
     * @param $id
     */
    public function __construct($id, string $asin, string $title, \DateTimeInterface $releaseDate, int $duration, string $summary, float $price, array $cast)
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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    public function getAsin(): string
    {
        return $this->asin;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDirector(): Individual
    {
        return $this->director;
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

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getSummary(): string
    {
        return $this->summary;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    abstract public function getMedia(): string;
}
