<?php

namespace App\Controller;

use App\Controller\Helper;
use App\Entity\Auteur;
use App\Entity\CategoriesRecipes;
use App\Entity\Orders;
use App\Entity\Recipes;
use App\Entity\Roles;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
      // ------------------------------------------------------ SIGNIN
    //////////////////////////////////////////////////////////////////


    /**
     * Formulaire pour ajouter un utilisateur
     * @Route("/signin", name="signin")
     */

    public function signin() {

        # Création d'un nouvel utilisateur
        $auteur = new User();

        # Récupération du role
        $role = $this->getDoctrine()
            ->getRepository(Roles::class)
            ->find(2);

        # Sauvegarde du role
        $auteur->setRoles($role);

        # Vérification des données du Formulaire
        if (isset($_POST['form']) && $_POST['form']['pass'] === $_POST['confirmation-pass']) :
            # Récupération des données
            $auteur->setMail($_POST['form']['mail']);
            $auteur->setName($_POST['form']['name']);
            $auteur->setPass($_POST['form']['pass']);

            $auteur->setAvatar('images/avatars/default_avatar.jpg');
            $auteur->setFirstname('');

            dump($auteur);

            # Insertion en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($auteur);
            $em->flush();

            # Récupération des variables de session
            if(!isset($session)) {$session = new Session();}

            $session->set('userName', $auteur->getFirstname() . ' ' . $auteur->getName());
            $session->set('userId',$auteur->getId());
            $session->set('template','template-01');
        endif;

        return $this->redirectToRoute('index');
    }




        //////////////////////////////////////////////////////////////////
      // ------------------------------------------------------ LOGIN
    //////////////////////////////////////////////////////////////////


    /**
     * Formulaire de connexion
     * @Route("/login", name="login")
     */

    public function login() {

        # Initialisation de la variable $message
        $message = '';

        dump($_POST);

        $repository = $this->getDoctrine()
            ->getRepository(User::class);

        # Récupération des données

            # On regarde si l'utilisateur est dans la BDD
            $error = $repository->loginUser($_POST['mail'], $_POST['pass']);

            dump($error);
            //die();

            if(!empty($error[0])) :
                # On ouvre une session (si besoin)
                if(!isset($session)) {$session = new Session();}

                $session->set('userName', $error[0][0]->getFirstname() . ' ' . $error[0][0]->getName());
                $session->set('userId', $error[0][0]->getId());
                $session->set('template','template-01');

                $user = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->find($session->get('userId'));

                $recettes = $this->getDoctrine()
                    ->getRepository(Recipes::class)
                    ->findAll();

                dump($user);
                //die();

                # Redirection
                return $this->render('index/index.html.twig', [
                    'user'          => $user,
                    'recettes'      => $recettes,
                    'message'       => $message
                   ]);

            else :
                $message = empty($error[1]) ? 'Email invalide' : 'Password invalide';

                # Affichage du Formulaire dans la Vue
                return $this->render('index/index.html.twig', [
                    'message'   => '<div class="alert alert-danger">' . $message . '</div>'
                ]);

            endif;

        # Affichage du Formulaire dans la Vue
        return $this->render('index/index.html.twig', [
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
              // ---------------------------------------------- MODIFIER MDP
            //////////////////////////////////////////////////////////////////


    public function updateAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('UserBundle:User')->find($id);

        $form = $this->get('form.factory')->create(UserEditType::class, $user);

        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $edit = $request->request->get('user_edit');
            if ($edit['password'] == "") {
                $user->setPassword($user->getPassword());
            } else {
                $encoder = $this->container->get('security.password_encoder');
                $newPasswordEncoded = $encoder->encodePassword($user, $edit['password']);
                $user->setPassword($newPasswordEncoded);
            }
            var_dump($edit);
            $em->flush();
            //return $this->redirectToRoute('user_homepage', array());
        }
        return $this->render('UserBundle:User:update.html.twig', array(
            'user' => $user,
            'form' => $form->createView(),
        ));
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

            // INITIALISATION RECETTE

        # Initialisation de la variable $message
        $message = '';

        # Création d'une nouvelle recette
        $recette = new Recipes();



                ############ # Récupération de l'auteur # ############

        $session = $this->get('session');

        # Récupération de l'ID de l'auteur
        $auteurId = $session->get('userId');

        # Recherche de l'Auteur de la recette
        $auteur = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($auteurId);

        # Récupération de l'auteur
        $recette->setCuisto($auteur);



                ############ # Récupération de la categorie # ############

        $categories = $this->getDoctrine()
            ->getRepository(CategoriesRecipes::class)
            ->findAll();


        //-------------------- FORMULAIRE --------------------------//

        # Créer le formuaire permettant l'ajout d'une recette
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

            ->add('categories_recipes', ChoiceType::class, [
                'choices' => [
                    $categories[0]->getNamesCategoriesRecipes() => $categories[0],
                    $categories[1]->getNamesCategoriesRecipes() => $categories[1],
                    $categories[2]->getNamesCategoriesRecipes() => $categories[0],
                    $categories[3]->getNamesCategoriesRecipes() => $categories[1],
                ],
                'required'  => true,
                'label'     => false,
                'attr'      =>  [
                    'class' => 'form-control'
                ]
            ])

            ->add('image', FileType::class, [
                'required'  => false,
                'label'     => false,
                'data_class' => null,
                'attr'          => [
                    'class'         => 'form-control'
                ]
            ])

            ->add('price', MoneyType::class, [
                'required'      => false,
                'currency'      => 'EUR',
                'label'         => false,
                'empty_data'    => 'Price',
                'attr'          => [
                    'class'         => 'form-control'
                ]
            ])

            ->add('quantity', IntegerType::class, [
                'required'      => false,

                'label'         => false,
                'empty_data'    => 1,
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

        dump($form->getData());



        # Vérification des données du Formulaire
        if ($form->isSubmitted()) :

            dump($recette);

            # Récupération des données
            $recette = $form->getData();

            if($recette->getImage() == null) :
                $recette->setImage('images/recettes/default.jpg');
            else :
                # Récupération de l'image
                $image = $recette->getImage();

                # String Aléatoire
                $chaine  = rand(1000000, 99999999);

                # Nom du fichier
                $fileName = $chaine.'.'.$image->guessExtension();

                dump($this);
                //die();

                $image->move(
                    $this->getParameter('recettes'),
                    $fileName
                );

                $recette->setImage('images/recettes/' . $fileName);
            endif;


            dump($recette);
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
            ->getRepository(Recipes::class)
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






            //////////////////////////////////////////////////////////////////
          // --------------------------------------------- RECHERCHE PLATS
        //////////////////////////////////////////////////////////////////


    /**
     * Formulaire de connexion
     * @Route("/recherche-plats", name="recherchePlats")
     */

    public function recherchePlats() {
        return $this->render('commun/liste-plats.html.twig', []);
    }




    //////////////////////////////////////////////////////////////////
    // ------------------------------------------------------ AUTEUR
    //////////////////////////////////////////////////////////////////



    /**
     * Recherche auteur
     * @Route("/auteur/{id}",
     *     name="auteur",
     *     requirements={"id" = "\d+"},
     *     methods={"GET"})
     * @param integer $id
     * @return Response
     */

    public function auteur($id) {

        $auteur = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

//        $reviews = $this->getDoctrine()
//            ->getRepository(Review::class)
//            ->findByAuteur($id);

        return $this->render('commun/affiche-auteur.html.twig', [
            'auteur'    => $auteur,
         //   'reviews'  => $reviews
        ]);
    }




    //////////////////////////////////////////////////////////////////
    // ------------------------------------------------------ Addresse
    //////////////////////////////////////////////////////////////////


    /**
     * Paramètre
     * @Route("/params", name="params")
     */


    public function params(Request $request)
    {

        //////Ajout d'une adresse en BDD/////

        // On crée une nouvelle address
        $address = new Address();

        # Créer le formuaire permettant l'ajout d'un utilisateur
        $formBuilder = $this->createFormBuilder($address);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
            ->add('street', TextType::class)
            ->add('zip_code', IntegerType::class)
            ->add('city', TextType::class)
            ->add('number', IntegerType::class)
            ->add('comment', TextType::class)
            ->add('save', SubmitType::class);
        // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();


        # Traitement des données POST
        $form->handleRequest($request);

        # Vérification des données du Formulaire
        if ($form->isSubmitted()) :

            # Récupération des données
            $address = $form->getData();

            dump($this);
            //die();

            # Insertion en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();


            # Redirection vers l'index
            return $this->render('index/index.html.twig', []);
        else :
            # Affichage de la Vue
            return $this->render('user/params.html.twig', [
                'form' => $form->createView(),
                'test'=> true,
            ]);
        endif;

        return $this->render('user/params.html.twig',[
            'form' => $form->createView(),
            'test'=> true,
        ]);
    }




    //////////////////////////////////////////////////////////////////
    // ---------------------------------------------------- Addresse Save
    //////////////////////////////////////////////////////////////////


    /**
     * Paramètre
     * @Route("/add-address", name="addressSave")
     */


    public function addressSave(Request $request)
    {

        //////Ajout d'une adresse en BDD/////

        // On crée une nouvelle address
        $address = new Address();


        # Vérification des données du Formulaire
        if (true) :

            dump($_POST);

            # Récupération des données
            $address->setStreet($_POST['form']['street']);
            $address->setZipCode($_POST['form']['zip_code']);
            $address->setCity($_POST['form']['city']);
            $address->setNumber($_POST['form']['number']);
            $address->setComment($_POST['form']['comment']);


            # Insertion en BDD
            $em = $this->getDoctrine()->getManager();
            $em->persist($address);
            $em->flush();


            # Redirection vers l'index
            return $this->render('index/index.html.twig', []);
        else :
            # Affichage de la Vue
            return $this->render('user/params.html.twig', [
                'form' => $form->createView(),
                'test'=> true,
            ]);
        endif;

        return $this->render('user/params.html.twig',[
            'form' => $form->createView(),
            'test'=> true,
        ]);
    }





    //////////////////////////////////////////////////////////////////
    // ---------------------------------------------------- sendReview
    //////////////////////////////////////////////////////////////////




    /**
     * Page permettant d'envoyer un message
     * @Route("/sendReview/{user1}/{user2}",
     *     name="sendReview",
     *     requirements={"user1" = "\d+"},
     *     methods={"GET"})
     * @param integer $user1
     * @param integer $user2
     * @return Response
     */

    public function sendReview($user1, $user2)
    {
        $review = new Review();

        // On récupère nos deux utilisateurs
        $emissaire = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($user1);

        $destinataire = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($user2);

        $review->setUser1($emissaire);
        $review->setuser2($destinataire);


//        $formBuilder = $this->createFormBuilder($review);
//
//        //
//        $formBuilder
//            ->add('comments', TextType::class)
//            ->add('notes', IntegerType::class);
//
//        // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard
//
//        // À partir du formBuilder, on génère le formulaire
//        $form = $formBuilder->getForm();



        # Récupération des données
        $review->setComments($_POST['form']['comments']);
        $review->setNotes($_POST['form']['notes']);

        // Fin de form

        # Insertion en BDD
        $em = $this->getDoctrine()->getManager();
        $em->persist($review);
        $em->flush();

        // Validation

        # Redirection vers l'index
        return $this->render('index/index.html.twig',[

            'test'=> true,
        ]);



    }



}