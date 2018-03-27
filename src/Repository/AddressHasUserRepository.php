<?php

namespace App\Repository;

use App\Entity\AddressHasUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AddressHasUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddressHasUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddressHasUser[]    findAll()
 * @method AddressHasUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddressHasUserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AddressHasUser::class);
    }

//    /**
//     * @return AddressHasUser[] Returns an array of AddressHasUser objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AddressHasUser
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
