<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriesRecipesRepository")
 */
class CategoriesRecipes
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
    private $names_categories_recipes;

    /**
     * @return mixed
     */
    public function getNamesCategoriesRecipes()
    {
        return $this->names_categories_recipes;
    }

    /**
     * @param mixed $names_categories_recipes
     */
    public function setNamesCategoriesRecipes($names_categories_recipes): void
    {
        $this->names_categories_recipes = $names_categories_recipes;
    }

    public function getId()
    {
        return $this->id;
    }
}
