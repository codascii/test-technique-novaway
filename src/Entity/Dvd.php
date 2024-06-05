<?php
declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Dvd extends Movie
{
    public function getMedia(): string
    {
        return 'DVD';
    }
}
