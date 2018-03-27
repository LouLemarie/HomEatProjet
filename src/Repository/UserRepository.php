<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }







            //////////////////////////////////////////////////////////////////
          // -------------------------------------------------- LOGINUSER
        //////////////////////////////////////////////////////////////////


    public function loginUser($email, $password)
    {
        $user = $this->createQueryBuilder('a')
            ->where('a.mail = :mail')->setParameter('mail', $email)
            ->andWhere('a.pass = :pass')->setParameter('pass', $password)
            ->getQuery()
            ->getResult();

        if (empty($user)) :
            $email = $this->createQueryBuilder('a')
                ->where('a.mail = :mail')->setParameter('mail', $email)
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
