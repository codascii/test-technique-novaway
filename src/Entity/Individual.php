<?php
declare(strict_types=1);

namespace App\Entity;

use App\Repository\IndividualRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\InheritanceType("SINGLE_TABLE")]
#[ORM\DiscriminatorColumn(name: "discriminator", type: "string")]
#[ORM\DiscriminatorMap(["actor" => "Actor", "writer" => "Writer", "director" => "Director"])]
#[ORM\Entity(repositoryClass: IndividualRepository::class)]
abstract class Individual
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string')]
    private $firstname;

    /**
     * @var string
     */
    #[ORM\Column(type: 'string')]
    private $lastname;

    /**
     * Individual constructor.
     */
    public function __construct(string $firstname, string $lastname)
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function getFirstname(): string
    {
        return $this->firstname;
    }

    public function getLastname(): string
    {
        return $this->lastname;
    }


}
