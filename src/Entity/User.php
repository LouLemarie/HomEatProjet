<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Flex\Recipe;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    //private $pseudo;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $mail;

    /**
     * @ORM\Column(type="string")
     */
    private $pass;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateInscription;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastConnexion;

    /**
     * @ORM\Column(type="string")
     */
    private $avatar;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AddressHasUser", mappedBy="user")
     */
    private $addressHasUser;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Orders", mappedBy="user")
     */
    private $orders;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Roles", inversedBy="user")
     */
    private $roles;




    /**
     * @return mixed
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**php
     * @param mixed $orders
     */
    public function setOrders (Orders $Orders)
    {
        $this->Orders = $Orders;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getAddressHasUser()
    {
        return $this->adressHasUser;
    }

    /**
     * @param mixed $addressHasUser
     */
    public function setaddressHasUser(addressHasUser $addressHasUser)
    {
        $this->addressHasUser = $addressHasUser;

        return $this;
    }
    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }

    /**
     * @return mixed
     */
    public function getRecipes()
    {
        return $this->recipes;
    }


    public function __construct()
    {
        $this->recipes          = new ArrayCollection();
        $this->dateInscription  = new \DateTime();
        $this->lastConnexion    = new \DateTime();
    }


    /**
     * @return mixed
     */
    public function getRoles()
    {
        return $this->roles;
    }

    public function addRecipe(Recipe $recipe)
    {
        $this->recipes[] = $recipe;
        return $this;
    }



    public function removeRecipe(Recipe $recipe)
    {
        $this->recipes->removeElement($recipe);
    }



    /**
     * @param mixed $roles
     */
    public function setRoles(Roles $roles)
    {
        $this->roles = $roles;
        return $this;
    }




    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail): void
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass): void
    {
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * @param mixed $dateInscription
     */
    public function setDateInscription($dateInscription): void
    {
        $this->dateInscription = $dateInscription;
    }

    /**
     * @return mixed
     */
    public function getLastConnexion()
    {
        return $this->lastConnexion;
    }

    /**
     * @param mixed $lastConnexion
     */
    public function setLastConnexion($lastConnexion): void
    {
        $this->lastConnexion = $lastConnexion;
    }

//    /**
//     * @return mixed
//     */
//    public function getPseudo()
//    {
//        return $this->pseudo;
//    }
//
//    /**
//     * @param mixed $pseudo
//     */
//    public function setPseudo($pseudo): void
//    {
//        $this->pseudo = $pseudo;
//    }


}
