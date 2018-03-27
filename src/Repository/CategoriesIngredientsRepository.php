<?php

namespace App\Repository;

use App\Entity\CategoriesIngredients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategoriesIngredients|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriesIngredients|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriesIngredients[]    findAll()
 * @method CategoriesIngredients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesIngredientsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategoriesIngredients::class);
    }

//    /**
//     * @return CategoriesIngredients[] Returns an array of CategoriesIngredients objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategoriesIngredients
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
