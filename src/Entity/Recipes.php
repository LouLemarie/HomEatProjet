<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipesRepository")
 */
class Recipes
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
    private $titre;
    /**
     * @ORM\Column(type="string")
     */
    private $image;
    /**
     * @ORM\Column(type="text", length=300)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", scale=2)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CategoriesRecipes", cascade={"persist"})
     */
    private $categories_recipes;
    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Ingredients", cascade={"persist"})
     */
    private $ingredients;
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", cascade={"persist"})
     */
    private $cuisto;
    /**
     * @return mixed
     */
    /**
     * @return mixed
     * @ORM\Column(type="time")
     */
    private $hour;

    /**
     * @return mixed
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * @param mixed $hour
     */
    public function setHour($hour): void
    {
        $this->hour = $hour;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;


    public function getCuisto()
    {
        return $this->cuisto;
    }

    /**
     * @param mixed $cuisto
     */
    public function setCuisto($cuisto): void
    {
        $this->cuisto = $cuisto;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient)
    {
        $this->ingredients[] = $ingredient;
        return $this;
    }

    public function removeIngredient (Ingredient $ingredient)
    {
        $this->ingredients->removeElement($ingredient);
    }

    /**
     * @return mixed
     */
    public function getCategoriesRecipes()
    {
        return $this->categories_recipes;
    }

    public function setCategoriesRecipes($categorie): void
    {
        $this->categories_recipes = $categorie;
    }




    public function __construct()
    {
        $this->ingredients          =   new ArrayCollection();
        $this->hour                 =   new \DateTime();
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre): void
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }
}
