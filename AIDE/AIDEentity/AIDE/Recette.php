<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecetteRepository")
 */

class Recette
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=800)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $image;

    /**
     * @ORM\Column(type="float")
     */
    private $prix;


    /**
     * @ORM\Column(type="datetime")
     */
    private $datecreation;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Categorie", cascade={"persist"})
     */
    private $categorie;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Auteur", inversedBy="recettes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $auteur;



    // ---------------------------- Constructeur


    public function __construct()
    {
        $this->datecreation = new \DateTime();
        $this->categorie    = new ArrayCollection();
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
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $descritption
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;
    }

    /**
     * @return mixed
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * @param mixed $datecreation
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;
    }

    /**
     * @return mixed
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * @param mixed $categorie
     */
    public function addCategorie($categorie)
    {
        $this->categorie[] = $categorie;
    }

    /**
     * @return mixed
     */
    public function getEtape()
    {
        return $this->etape;
    }

    /**
     * @param mixed $etape
     */
    public function setEtape($etape)
    {
        $this->etape = $etape;
    }

    /**
     * @return mixed
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * @param mixed $auteur
     */
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;
    }

}
