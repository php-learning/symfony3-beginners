<?php

namespace MeetupBundle\Controller;

use MeetupBundle\Entity\Article;
use MeetupBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->orderByOrdre();
        return $this->render('MeetupBundle:Default:index.html.twig', [
            "categories" => $categories
        ]);
    }

    /**
     * @Route("/article")
     */
    public function articleAction()
    {
        /**
         * @var Category $categorie
         */
        $categorie = $this->getDoctrine()->getRepository(Category::class)->find(16);
        return $this->render('MeetupBundle:Default:article.html.twig', [
            "articles" => $categorie->getArticles()
        ]);
    }

    /**
     * @Route("/article/new")
     * @param Request $request
     * @return Response
     */
    public function newArticleAction(Request $request)
    {
        $article = new Article();
        $article->setCreated(new \DateTime("now"));
        $form = $this->createFormBuilder($article)
            ->add('name', TextType::class)
            ->add('content', TextType::class)
            ->add('published', DateType::class)
            ->add('author', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Post'))
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $article = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

        }
        return $this->render('MeetupBundle:Default:form.html.twig', array(
            'form' => $form->createView()));
    }

    /**
     * @Route("/nombre")
     */
    public function numberAction()
    {
        $number = mt_rand(0, 100);
        return new Response('lucky number: ' . $number . '');
    }


    /**
     * @Route("/about")
     */
    public function aboutAction()
    {
        return $this->render('MeetupBundle:Default:about.html.twig',
            [
                "page_title" => "About page",
                "navigation" => [
                    [
                        "caption" => "premier lien",
                        "href" => "http://www.google.fr"
                    ],
                    [
                        "caption" => "deuxieme lien",
                        "href" => "http://www.google.fr"
                    ],
                ]
            ]
        );
    }
}
