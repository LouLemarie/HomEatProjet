<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IngredientsRepository")
 */
class Ingredients
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
    private $names_ingredients;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\CategoriesIngredients", cascade={"persist"})
     */
    private $categories_ingredients;

    /**
     * @ORM\Column(type="boolean")
     */
    private $allergenes;


    public function __construct()
    {
        $this->categories_ingredients = new ArrayCollection();
    }

    public function addCategoryIngredient (CategoryIngredient $CategoryIngredient)
    {
        $this->categories_ingredients[] = $CategoryIngredient;
        return $this;
    }

    public function removeCategoryIngredient (CategoryIngredient $CategoryIngredient)
    {
        $this->categories_ingredients->removeElement($CategoryIngredient);
    }

    /**
     * @return mixed
     */
    public function getCategoriesIngredients()
    {
        return $this->categories_ingredients;
    }


    /**
     * @return mixed
     */
    public function getNamesIngredients()
    {
        return $this->names_ingredients;
    }

    /**
     * @param mixed $names_ingredients
     */
    public function setNamesIngredients($names_ingredients): void
    {
        $this->names_ingredients = $names_ingredients;
    }

    /**
     * @return mixed
     */
    public function getAllergenes()
    {
        return $this->allergenes;
    }

    /**
     * @param mixed $allergenes
     */
    public function setAllergenes($allergenes): void
    {
        $this->allergenes = $allergenes;
    }

    public function getId()
    {
        return $this->id;
    }
}
