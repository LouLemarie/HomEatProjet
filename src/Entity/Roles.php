<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RolesRepository")
 */
class Roles
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
    private $name_role;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\User", mappedBy="roles")
     */
    private $user;

    /**
     * @ORM\Column(type="text", length=300)
     */
    private $description_role;



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
    public function getNameRole()
    {
        return $this->name_role;
    }

    /**
     * @param mixed $name_role
     */
    public function setNameRole($name_role): void
    {
        $this->name_role = $name_role;
    }

    /**
     * @return mixed
     */
    public function getDescriptionRole()
    {
        return $this->description_role;
    }

    /**
     * @param mixed $description_role
     */
    public function setDescriptionRole($description_role): void
    {
        $this->description_role = $description_role;
    }



    public function getId()
    {
        return $this->id;
    }
}
