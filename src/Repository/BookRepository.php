<?php

namespace App\Repository;

use App\Entity\Book;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    /**
     * @return mixed
     */
    public function getLast(int $limit = 4): array
    {
        // Pour éviter que l'on mette une limite nulle ou négative
        $limit = $limit < 1 ? 1 : $limit;
        
        return $this->createQueryBuilder('b')
            ->orderBy('b.publishDate', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }
}
