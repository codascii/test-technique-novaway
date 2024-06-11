<?php

namespace App\Repository;

use App\Entity\Individual;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Individual|null find($id, $lockMode = null, $lockVersion = null)
 * @method Individual|null findOneBy(array $criteria, array $orderBy = null)
 * @method Individual[]    findAll()
 * @method Individual[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndividualRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Individual::class);
    }
}
