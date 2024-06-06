<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
final class BluRay extends Movie
{
    public function getMedia(): string
    {
        return 'BluRay';
    }
}
