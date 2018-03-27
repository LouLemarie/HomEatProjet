<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UstensileRepository")
 */
class Ustensile
{

    // ---------------------------- Variables BDD


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $marque;

    /**
     * @ORM\Column(type="float", length=150)
     */
    private $note;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Fonction", inversedBy="ustensiles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $fonction;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Recette", inversedBy="ustensiles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recette;


    // ---------------------------- Constructeur


    public function __construct()
    {

    }


    // ---------------------------- Getteur/Setteur

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * @param mixed $marque
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }


}
