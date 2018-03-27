<?php

namespace App\Repository;

use App\Entity\Auteur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class AuteurRepository extends ServiceEntityRepository
{
    // ----------------------------------------------------------- Constructor
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Auteur::class);
    }



                    //////////////////////////////////////////////////////////////////
                  // -------------------------------------------------- LOGINUSER
                //////////////////////////////////////////////////////////////////


    public function loginUser($email, $password)
    {
        $user = $this->createQueryBuilder('a')
            ->where('a.email = :email')->setParameter('email', $email)
            ->andWhere('a.password = :password')->setParameter('password', $password)
            ->getQuery()
            ->getResult();

        if (empty($user)) :
            $email = $this->createQueryBuilder('a')
                ->where('a.email = :email')->setParameter('email', $email)
                ->getQuery()
                ->getResult();
        endif;

        return array($user, $email);


    }




                        //////////////////////////////////////////////////////////////////
                      // -------------------------------------------------- FINDUSER
                    //////////////////////////////////////////////////////////////////


    public function findUser($id_user)
    {
        $user =
            $this->createQueryBuilder('a')
                ->where('a.id = :id_user')->setParameter('id_user', $id_user)
                ->getQuery()
                ->getResult();

        return array($user);
    }

}
