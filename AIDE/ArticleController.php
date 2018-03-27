<?php

namespace App\Controller\TechNews;

use App\Controller\Helper;
use App\Entity\Article;
use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\Recette;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Article;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class ArticleController extends Controller
{

    use Helper;


        //////////////////////////////////////////////////////////////////
      // ---------------------------------------------- INDEX ARTICLE
    //////////////////////////////////////////////////////////////////


    /**
     * Démonstration, Ajouter un Article avec Doctrine
     * @Route("/article", name="article")
     */
    public function index()
    {
        # Création de la Catégorie
        $categorie = new Categorie();
        $categorie->setLibelle('Business');

        # Création de l'Auteur
        $auteur = new Auteur();
        $auteur->setPrenom('Hugo');
        $auteur->setNom('LIEGEARD');
        $auteur->setEmail('wf3@hl-media.fr');
        $auteur->setPassword('test');

        # Création de notre Article
        $article = new Article();
        $article->setTitre('Ceci est un titre');
        $article->setContenu('Ceci est un contenu');
        $article->setFeaturedimage('3.jpg');
        $article->setSpecial(0);
        $article->setSpotlight(1);

        # On associe une catégorie et un auteur à notre article
        $article->setCategorie($categorie);
        $article->setAuteur($auteur);

        # On sauvegarde le tout en BDD
        $em = $this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->persist($auteur);
        $em->persist($article);
        $em->flush();

        # Retour de la vue
        return new Response(
            'Nouvel article ajouté avec ID: ' .
            $article->getId() . ' et la nouvelle catégorie : ' .
            $categorie->getLibelle() . ' de Auteur : ' .
            $auteur->getPrenom()
        );

    }




        //////////////////////////////////////////////////////////////////
      // ------------------------------------------------- ADD ARTICLE
    //////////////////////////////////////////////////////////////////



    /**
     * Formulaire pour ajouter un article
     * @Route("/creer-un-article", name="addArticle")
     */
    public function addArticle(Request $request) {

        # Récupération des Catégories
        $categories = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->findAll();

        # Création d'un nouvel article
        $article = new Article();

        # Récupération d'un Auteur de l'article
        $auteur = $this->getDoctrine()
            ->getRepository(Auteur::class)
            ->find(2);

        $article->setAuteur($auteur);

        # Créer le formuaire permettant l'ajout d'un article
        $form = $this->createFormBuilder($article)

            ->add('titre', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'class'         => 'form-control',
                    'placeholder'   => 'Titre de l\'Article'
                ]
            ])

            ->add('categorie', EntityType::class, [
                'class'         => Categorie::class,
                'choice_label'  => 'libelle',
                'required'      => true,
                'expanded'      => false,
                'multiple'      => false,
                'attr'          => [
                    'class' => 'form-control'
                ]
            ])

            ->add('contenu', TextareaType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'class'         =>  'form-control'
                ]
            ])

            ->add('featuredimage', FileType::class, [
                'required'  => false,
                'label'     => false,
                'attr'      => [
                    'class' => 'dropify'
                ]
            ])

            ->add('special', CheckboxType::class, [
                'required'  => false,
                'label'     => false,
            ])

            ->add('spotlight', CheckboxType::class, [
                'required'  => false,
                'label'     => false,
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Publier',
                'attr'      => [
                    'class' => 'btn btn-primary'
                ]
            ])

            ->getForm();

        # Traitement des données POST
        $form->handleRequest($request);

        # Vérification des données du Formulaire
        if ($form->isSubmitted() && $form->isValid()) :
            # Récupération des données
            $article = $form->getData();

            # Récupération de l'image
            $image = $article->getFeaturedimage();

            # Nom du fichier
            $fileName = $this->slugify($article->getTitre().$image->guessExtension());
            $image->move(
                $this->getParameter('articles_assets_dir'),
                $fileName
            );
            $article->setFeaturedimage($fileName);

            # Insertion en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            # Redirection sur l'Article qui vient d'être créé.
            return $this->redirectToRoute('index_article', [
                'libellecategorie' => $this->slugify($article->getCategorie()->getLibelle()),
                'slugarticle'      => $this->slugify($article->getTitre()),
                'id'               => $article->getId()
            ]);
        endif;

        # Affichage du Formulaire dans la Vue
        return $this->render('article/ajouterarticle.html.twig', [
            'form' => $form->createView()
        ]);

    }




        //////////////////////////////////////////////////////////////////
      // ------------------------------------------------------ SIGNIN
    //////////////////////////////////////////////////////////////////


    /**
     * Formulaire pour ajouter un utilisateur
     * @Route("/signin", name="signin")
     */

    public function signin(Request $request) {

        # Création d'un nouvel utilisateur
        $auteur = new Auteur();

        # Créer le formuaire permettant l'ajout d'un utilisateur
        $form = $this->createFormBuilder($auteur)

            ->add('nom', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'placeholder'   => 'Entrez votre nom ...',
                    'class'         =>  'form-control'
                ]
            ])

            ->add('prenom', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'placeholder'   => 'Entrez votre prenom ...',
                    'class'         => 'form-control'
                ]
            ])

            ->add('email', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'placeholder'   => 'Entrez votre mail ...',
                    'class'         => 'form-control'
                ]
            ])

            ->add('password', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'placeholder'   => 'PASSWORD',
                    'class'         => 'form-control'
                ]
            ])
/*
            ->add('avatar', FileType::class, [
                'required'  => false,
                'label'     => false,
            ])
*/
            ->add('submit', SubmitType::class, [
                'label'         => false,
                'attr'          => [
                    'class'         =>  'btn btn-danger'
                ]
            ])

            ->getForm();

        # Traitement des données POST
        $form->handleRequest($request);

        # Vérification des données du Formulaire
        if ($form->isSubmitted() && $form->isValid()) :
            # Récupération des données
            $auteur = $form->getData();

            # Insertion en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($auteur);
            $em->flush();

            return $this->redirectToRoute('index');

        endif;

        # Affichage du Formulaire dans la Vue
        return $this->render('user/signin.html.twig', [
            'form' => $form->createView()
        ]);
    }




        //////////////////////////////////////////////////////////////////
      // ------------------------------------------------------ LOGIN
    //////////////////////////////////////////////////////////////////


    /**
     * Formulaire de connexion
     * @Route("/login", name="login")
     */

    public function login(Request $request) {

        # Initialisation de la variable $message
        $message = '';

        # Création d'un nouvel utilisateur
        $auteur = new Auteur();

        # Créer le formuaire permettant l'ajout d'un utilisateur
        $form = $this->createFormBuilder($auteur)

            ->add('email', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'placeholder'   => 'Entrez votre mail ...',
                    'class'         => 'form-control'
                ]
            ])

            ->add('password', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'placeholder'   => 'PASSWORD',
                    'class'         => 'form-control'
                ]
            ])

            ->add('submit', SubmitType::class, [
                'label' => false,
                'attr'          => [
                    'value'         => 'login',
                    'class'         => 'btn btn-form'
                ]
            ])

            ->getForm();

        # Traitement des données POST
        $form->handleRequest($request);

        # Vérification des données du Formulaire
        if ($form->isSubmitted() && $form->isValid()) :
            $repository = $this->getDoctrine()
                ->getRepository(Auteur::class);

            # Récupération des données
            $auteur = $form->getData();

            # On regarde si l'utilisateur est dans la BDD
            $error = $repository->loginUser($auteur->getEmail(), $auteur->getPassword());

            dump($error[0][0]->getId());

            if(!empty($error[0])) :
                # On ouvre une session (si besoin)
                if(!isset($session)) {$session = new Session();}

                $session->set('userName', $error[0][0]->getPrenom() . ' ' . $error[0][0]->getNom());
                $session->set('userId', $error[0][0]->getId());
                $session->set('template','template-01');

                # Redirection
                return $this->redirectToRoute('index');

            else :
                $message = empty($error[1]) ? 'Email invalide' : 'Password invalide';

                # Affichage du Formulaire dans la Vue
                return $this->render('user/login.html.twig', [
                    'form'      => $form->createView(),
                    'message'   => '<div class="alert alert-danger">' . $message . '</div>'
                ]);

            endif;


        endif;

        # Affichage du Formulaire dans la Vue
        return $this->render('user/login.html.twig', [
            'form'      => $form->createView(),
            'message'   => $message
        ]);
    }




                //////////////////////////////////////////////////////////////////
              // ----------------------------------------------------- LOGOUT
            //////////////////////////////////////////////////////////////////


    /**
     * Formulaire de connexion
     * @Route("/logout", name="logout")
     */

    public function logout(SessionInterface $session) {

        # On sauvegarde et ferme la session
        $session->clear();

        # Retour vers l'index
        return $this->redirectToRoute('index', []);
    }




            //////////////////////////////////////////////////////////////////
          // ----------------------------------------------------- EDITOR
        //////////////////////////////////////////////////////////////////


    /**
     * Formulaire de connexion
     * @Route("/editor", name="editor")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */

    public function editor(Request $request) {

        # Initialisation de la variable $message
        $message = '';

        # Création d'un nouvel utilisateur
        $recette = new Recette();

        # Récupération des variables de session
        $session = $this->get('session');

        # Récupération de l'ID de l'auteur
        $auteurId = $session->get('userId');

        # Récupération des catégories
        $listeCategories = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->findAll();

        dump($listeCategories);
        //die();

        # Recherche de l'Auteur de la recette
        $auteur = $this->getDoctrine()
            ->getRepository(Auteur::class)
            ->find($auteurId);

        dump($auteur);
        //die();

        # Récupération de l'auteur
        $recette->setAuteur($auteur);

        # Récupération de l'image
        $recette->setImage('images/recettes/02.jpg');

        # Récupération du prix
        $recette->setPrix(5);


        # Créer le formuaire permettant l'ajout d'un utilisateur
        $form = $this->createFormBuilder($recette)

            ->add('titre', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'placeholder'   => 'Titre de votre recette...',
                    'class'         => 'form-control'
                ]
            ])

            ->add('description', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'placeholder'   => 'Description',
                    'class'         => 'form-control'
                ]
            ])

            ->add('prix', MoneyType::class, [
                'required'      => false,
                'currency'      => 'USD',
                'label'         => false,
                'empty_data'    => 'Prix',
                'attr'          => [
                    'class'         => 'form-control'
                ]
            ])


            ->add('submit', SubmitType::class, [
                'label'         => false,
                'attr'          => [
                    'class'         => 'btn btn-primary'
                ]
            ])

            ->getForm();


        # Traitement des données POST
        $form->handleRequest($request);

        dump($form);
        //die();


        # Vérification des données du Formulaire
        if ($form->isSubmitted()) :

            # Récupération des données
            $recette = $form->getData();

            # Traitement des erreurs
            // [...]

            //dump($recette);
            //die();

            # Insertion en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($recette);
            //$em->persist($categorie);
            $em->flush();


            # Redirection vers l'index
            return $this->redirectToRoute('index');

        endif;


        # Affichage du Formulaire dans la Vue
        return $this->render('commun/editor.html.twig', [
            'form'      => $form->createView(),
            'message'   => $message
        ]);
    }



        //////////////////////////////////////////////////////////////////
      // ------------------------------------------- ALAKAZAMRESPONSE
    //////////////////////////////////////////////////////////////////


    /**
     * Formulaire de connexion
     * @Route("/alakazamResponse", name="alakazamResponse")
     */

    public function alakazamResponse(SessionInterface $session) {

        # Affichage de la Vue
        return $this->render('alakazam/response.html.twig', []);
    }





        //////////////////////////////////////////////////////////////////
      // -------------------------------------------------- CATEGORIE
    //////////////////////////////////////////////////////////////////


    /**
     * Page permettant d'afficher les articles d'une catégorie
     * @Route("/categorie/{libellecategorie}",
     *     name="categorie",
     *     requirements={"libellecategorie" = "\w+"},
     *     methods={"GET"})
     * @param string $libellecategorie
     * @return Response
     */

    public function categorie($libellecategorie = 'tout') {
        # Récupération de la catégorie (pour récupérer les articles liés à cette catégorie mais fail)
        /*
        $categorie = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->findBy(['libelle' => $libellecategorie]);

        dump($categorie);
        */

        # Initialisation de $recettes
        $recettes = [];

        # Récupération des variables de session
        $session = $this->get('session');

        # Récupération de toutes les recettes de l'utilisateur
        $Allrecettes = $this->getDoctrine()
            ->getRepository(Recette::class)
            ->findBy(['auteur' => $session->get('userId')]);

        # On test la catégorie de chaque recette
        foreach ($Allrecettes as $recette) {
            $categories = $recette->getCategorie();

            foreach ($categories as $categorie)  {
                if($categorie != null) {
                    dump($categorie->getLibelle());
                    if (strtolower($categorie->getLibelle()) == $libellecategorie) {
                        array_push($recettes, $recette);
                    }
                }
            }
        }

       dump($recettes);
       //die();

        if (!$recettes) :
            # Affichage de la Vue
            return $this->render('commun/categorie.html.twig', [
                'message' => 'Aucune recette liées à cette catégorie n\' a été trouvé',
            ]);
        else :
            # Affichage de la Vue
            return $this->render('commun/categorie.html.twig', [
                'recettes' => $recettes,
            ]);
        endif;
    }



                //////////////////////////////////////////////////////////////////
              // -------------------------------------------- PERSONNALISATION
            //////////////////////////////////////////////////////////////////


    /**
     * Formulaire de connexion
     * @Route("/personnalisation", name="personnalisation")
     */

    public function personnalisation() {
        return $this->render('commun/personnalisation.html.twig', []);
    }



                //////////////////////////////////////////////////////////////////
              // ---------------------------------------------- switchTemplate
            //////////////////////////////////////////////////////////////////


    /**
     * Formulaire de connexion
     * @Route("/personnalisation/changement-de-template", name="switchTemplate")
     */

    public function switchTemplate(Session $session) {
        $session->set('template', $_POST['template']);
        return $this->redirectToRoute('index');
    }




                //////////////////////////////////////////////////////////////////
              // ---------------------------------------------- searchRecette
            //////////////////////////////////////////////////////////////////


    /**
     * Formulaire de connexion
     * @Route("/searchRecette", name="searchRecette")
     */

    public function searchRecette() {
        return $this->render('commun/recherche-recette.html.twig', []);
    }






}