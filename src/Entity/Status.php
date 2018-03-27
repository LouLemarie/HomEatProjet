<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatusRepository")
 */
class Status
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
    private $names_status;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Orders", mappedBy="status")
     */
    private $orders;

    /**
     * @ORM\Column(type="text", length=300)
     */
    private $descriptions_status;

    /**
     * @return mixed
     */
    public function getOrders()
    {
        return $this->orders;
    }

    /**
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
    public function getNamesStatus()
    {
        return $this->names_status;
    }

    /**
     * @param mixed $names_status
     */
    public function setNamesStatus($names_status): void
    {
        $this->names_status = $names_status;
    }

    /**
     * @return mixed
     */
    public function getDescriptionsStatus()
    {
        return $this->descriptions_status;
    }

    /**
     * @param mixed $descriptions_status
     */
    public function setDescriptionsStatus($descriptions_status): void
    {
        $this->descriptions_status = $descriptions_status;
    }

    public function getId()
    {
        return $this->id;
    }
}
