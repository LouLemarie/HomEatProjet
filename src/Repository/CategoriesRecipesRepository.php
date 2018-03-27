<?php

namespace App\Repository;

use App\Entity\CategoriesRecipes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategoriesRecipes|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoriesRecipes|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoriesRecipes[]    findAll()
 * @method CategoriesRecipes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoriesRecipesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategoriesRecipes::class);
    }

//    /**
//     * @return CategoriesRecipes[] Returns an array of CategoriesRecipes objects
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
    public function findOneBySomeField($value): ?CategoriesRecipes
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
