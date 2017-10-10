<?php

namespace MeetupBundle\Controller;

use MeetupBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $categories = $this->getDoctrine()->getRepository(Category::class)->orderByOrdre();
        return $this->render('MeetupBundle:Default:index.html.twig',[
            "categories"=>$categories
        ]);
    }

    /**
     * @Route("/nombre")
     */
    public function numberAction()
    {
        $number = mt_rand(0,100);
        return new Response('lucky number: ' . $number .'');
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
