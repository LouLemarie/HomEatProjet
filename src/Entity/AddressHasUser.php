<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AddressHasUserRepository")
 */
class AddressHasUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Address",  inversedBy="addressHasUser")
     */
    private $address;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="addressHasUser")
     */
    private $user;



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
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;
        return $this;
    }
    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }


    public function getId()
    {
        return $this->id;
    }
}
