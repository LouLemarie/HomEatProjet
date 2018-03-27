<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AddressRepository")
 */
class Address
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AddressHasUser",  mappedBy="address")
     */
    private $addressHasUser;


    /**
     * @ORM\Column(type="string", length=150)
     */
    private $street;

    /**
     * @ORM\Column(type="integer")
     */
    private $zip_code;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $city;

    /**
     * @ORM\Column(type="text", length=300)
     */
    private $comment;

    /**
     * @ORM\Column(type="integer")
     */
    private $number;



    /**
     * @return mixed
     */
    public function getAddressHasUser()
    {
        return $this->addressHasUser;
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


    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param mixed $number
     */
    public function setNumber($number): void
    {
        $this->number = $number;
    }

    /**
     * @return mixed
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param mixed $street
     */
    public function setStreet($street): void
    {
        $this->street = $street;
    }

    /**
     * @return mixed
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * @param mixed $zip_code
     */
    public function setZipCode($zip_code): void
    {
        $this->zip_code = $zip_code;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment): void
    {
        $this->comment = $comment;
    }


    public function getId()
    {
        return $this->id;
    }
}
