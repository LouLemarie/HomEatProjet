<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;




    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Review", cascade={"persist"})
     */
    private $reviews;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status", inversedBy="orders")
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recipes", cascade={"persist"})
     */
    private $recipes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="orders")
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantities;


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

    /**
     * @return mixed
     */
    public function getRecipes()
    {
        return $this->recipes;
    }
    public function setRecipes(Recipes $recipes)
    {
        $this->recipes = $recipes;
        return $this;
    }



    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }


    public function setStatus(Status $status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReviews()
    {
        return $this->reviews;
    }

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function addReview (Review $Review)
    {
        $this->reviews[] = $Review;
        return $this;
    }

    public function removeReview (Review $Review)
    {
        $this->reviews->removeElement($Review);
    }



    /**
     * @return mixed
     */
    public function getQuantities()
    {
        return $this->quantities;
    }

    /**
     * @param mixed $quantities
     */
    public function setQuantities($quantities): void
    {
        $this->quantities = $quantities;
    }



    public function getId()
    {
        return $this->id;
    }
}
