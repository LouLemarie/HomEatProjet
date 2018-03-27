<?php

namespace App\Repository;

use App\Entity\Recette;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Recette::class);
    }

    public function findAuteur($auteurId) {
        $recettes =  $this->createQueryBuilder('a')
            ->where('a.auteur = :auteur')->setParameter('auteur', $auteurId)
            ->getQuery()
            ->getResult();

        return $recettes;
    }
}
