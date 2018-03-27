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
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class IndexController extends Controller
{

    /**
     * Page d'accueil de notre site.
     * Configuration de notre route dans routes.yaml
     */
    public function index() {
        # Initialisation de $message
        $message = '';

        # Récupération des variables de session
        $session = $this->get('session');

        # Récupération de l'ID de l'auteur
        $auteurId = $session->get('userId');

        # Recherche des recettes de l'auteur
        $recettes = $this->getDoctrine()
            ->getRepository(Recipes::class)
            ->findAll();

        //die();

        return $this->render('index/index.html.twig', [
            'recettes'          => $recettes,
            'message'           => $message,
        ]);
    }




    // ------------------------------------------------------------






    public function sidebar() {

        return $this->render('components/_sidebar.html.twig', [

        ]);

    }


    // ------------------------------------------------------------



    public function sidebarleft() {
        return $this->render('components/_sidebarleft.html.twig', [

        ]);
    }



    // ------------------------------------------------------------



    public function menu() {
        return $this->render('onglets/menu.html.twig', [
            'test' => 'Salut'
        ]);
    }


    // ------------------------------------------------------------


    public function onglets() {
        return $this->render('components/_onglet.html.twig', []);
    }


    // ------------------------------------------------------------


    public function alakazamQuestions() {
        return $this->render('alakazam/questions.html.twig', []);
    }


    // ------------------------------------------------------------


    public function mesrecettes() {
        # Initialisation de $message
        $message = '';

        # Récupération des variables de session
        $session = $this->get('session');

        # Récupération de l'ID de l'auteur
        $auteurId = $session->get('userId');

        # Recherche des recettes de l'auteur
        $recettes = $this->getDoctrine()
            ->getRepository(Recipes::class)
            ->findAuteur($auteurId);

        return $this->render('user/mesrecettes.html.twig', [
            'recettes' => $recettes,
            'message' => $message
        ]);
    }



    // ------------------------------------------------------------


    public function navbar() {
        return $this->render('components/_nav.html.twig');
    }



    // ------------------------------------------------------------


    public function plats() {
        # Récupération de la liste de plats
        $plats = $this->getDoctrine()
            ->getRepository(Recipes::class)
            ->findAll();

        return $this->render('commun/liste-plats.html.twig', [
            "plats"  => $plats
        ]);
    }



    // -------------------------------------------------------------
    public function user() {
        #Récupération des variables de session
        $session = $this->get('session');

        # Récupération de l'ID de l'auteur
        $auteurId = $session->get('userId');

        # Récupération de l'utilisateur
        $auteur =  $this->getDoctrine()
            ->getRepository(User::class)
            ->find($auteurId);

        return $this->render('components/_interface-utilisateur.html.twig', [
            'user' => $auteur
        ]);
    }



    // ------------------------------------------------------------

    public function inscription(Request $request) {

        # Création d'un nouvel utilisateur
        $auteur = new User();

        # Récupération du role
        $role = $this->getDoctrine()
            ->getRepository(Roles::class)
            ->find(2);

        dump($role);
//        die();


        # Créer le formuaire permettant l'ajout d'un utilisateur
        $form = $this->createFormBuilder($auteur)

            ->add('name', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'placeholder'   => 'Pseudo ...',
                    'class'         =>  'validate',
                    'name'          =>  'name'
                ]
            ])

//            ->add('firstname', TextType::class, [
//                'required'      => true,
//                'label'         => false,
//                'attr'          => [
//                    'placeholder'   => '',
//                    'class'         => 'validate'
//                ]
//            ])

            ->add('mail', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'placeholder'   => 'Email ...',
                    'class'         => 'validate',
                    'name'          => 'mail'
                ]
            ])

            ->add('pass', TextType::class, [
                'required'      => true,
                'label'         => false,
                'attr'          => [
                    'placeholder'   => 'Password ...',
                    'class'         => 'validate',
                    'style'         => 'margin-bottom: 0px',
                    'name'          => 'pass'
                ]
            ])

    //            ->add('avatar', FileType::class, [
    //                'required'  => false,
    //                'label'     => false,
    //                'attr'      =>[
    //                    'class' => 'dropify'
    //                ]
    //            ])

            ->add('submit', SubmitType::class, [
                'label'         => false,
                'attr'          => [
                    'class'         =>  'btn waves-effect waves-light',
                    'value'         =>  'Go !'
                ]
            ])

            ->getForm();

//        if ($request->isMethod('POST')) {
//            $form->submit($request->request->get($form->getName()));
//
//            # Vérification des données du Formulaire
//            if ($form->isSubmitted()) :
//                # Récupération des données
//                $auteur = $form->getData();
//
//                # Récupération de l'image
//                $image = $auteur->getAvatar();
//
//                # Récupération du firstname
//                $auteur->setFirstname('');
//
//                # Sauvegarde du role
//                $auteur->setRoles($role);
//
////            # String Aléatoire
////            $chaine  = rand(1000000, 99999999);
////
////            # Nom du fichier
////            $fileName = $chaine.'.'.$image->guessExtension();
////
////            dump($this);
////            //die();
////
////            $image->move(
////                $this->getParameter('avatars'),
////                $fileName
////            );
//
//                $auteur->setAvatar('images/avatars/default_avatar.jpg');
//
//                dump($auteur);
//                die();
//
//                # Insertion en BDD
//                $em = $this->getDoctrine()->getManager();
//                $em->persist($auteur);
//                $em->flush();
//
//                # Récupération des variables de session
//                if(!isset($session)) {$session = new Session();}
//
//                $session->set('userName', $auteur->getFirstname() . ' ' . $auteur->getName());
//                $session->set('userId',$auteur->getId());
//                $session->set('template','template-01');
//
//            endif;
//        }

        # Affichage du Formulaire dans la Vue
        return $this->render('components/_inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }


}
