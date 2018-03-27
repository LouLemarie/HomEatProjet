<?php

namespace App\Controller\TechNews;


use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Recette;
use App\Service\Article\ArticleProvider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Article;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
            ->getRepository(Recette::class)
            ->findAuteur($auteurId);

        //die();

        return $this->render('index/index.html.twig', [
            'recettes'          => $recettes,
            'message'           => $message
        ]);
    }



    // ------------------------------------------------------------



    /**
     * Page permettant d'afficher un Article
     * @Route("/{libellecategorie}/{slugarticle}_{id}.html",
     *     name="index_article",
     *     requirements={"idarticle" = "\d+"})
     */
    public function article(Article $article) {
        # Recupération avec Doctrine
        // $article = $this->getDoctrine()
        //    ->getRepository(Article::class)
        //    ->find($idarticle);        -----> No need caus' we changed variables in function article()

        # Récupération des suggestions
        $suggestions = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findArticleSuggestions($article->getId(),$article->getCategorie()->getId());

        # Récupération des lastArticles
        $lastArticles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findLastFiveArticle();

        # Si aucun article n'a été trouvé
        if(!$article) :
            # On génère une exception
            // throw $this->createNotFoundException("Nous n'avons pas trouvé d'article ID : $idarticle");

            # Ou on peut aussi rediriger l'utilisateur sur la page index
            return $this->redirectToRoute('index',[],Response::HTTP_MOVED_PERMANENTLY);

        endif;

        return $this->render('index/article.html.twig', [
            'article'           =>      $article,
            'suggestions'       =>      $suggestions,
            '$lastArticles'     =>      $lastArticles
        ]);
        }





    // ------------------------------------------------------------






    public function sidebar() {

        # Récupération du Répository
        $repository = $this->getDoctrine()->getRepository(Article::class);

        # Récupération des 5 derniers articles
        $lastArticles   = $repository->findLastFiveArticle();

        # Récupération des articles à la position "special"
        $special    = $repository->findSpecialArticles();

        return $this->render('components/_sidebar.html.twig', [
            'lastArticles'  =>  $lastArticles,
            'special'       =>  $special
        ]);

    }


    // ------------------------------------------------------------



    public function sidebarleft() {
        # Initiamlisation de la recette
        $recette = new Recette();

        # Initialisation des categories
        $categories = [];

        # On récupère la liste des catégories
        $listeCategories = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->findAll();

        foreach ($listeCategories as $categorie) {
            $categories[$categorie->getLibelle()] = $categorie->getId();
        }

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

            ->add('categorie', ChoiceType::class, [
                'required'      => true,
                'label'         => false,
                'choices'       => $categories,
                'attr'          => [
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

        return $this->render('components/_sidebarleft.html.twig', [
            'form'  => $form->createView(),
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
            ->getRepository(Recette::class)
            ->findAuteur($auteurId);

        return $this->render('user/mesrecettes.html.twig', [
            'recettes' => $recettes,
            'message' => $message
        ]);
    }


}
