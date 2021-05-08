<?php

namespace App\Repository;

use App\Entity\MailContent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MailContent|null find($id, $lockMode = null, $lockVersion = null)
 * @method MailContent|null findOneBy(array $criteria, array $orderBy = null)
 * @method MailContent[]    findAll()
 * @method MailContent[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MailContentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MailContent::class);
    }

    // /**
    //  * @return MailContent[] Returns an array of MailContent objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MailContent
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
