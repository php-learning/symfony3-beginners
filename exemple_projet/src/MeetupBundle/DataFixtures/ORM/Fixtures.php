<?php
/**
 *
 * $Author: $
 * $Rev: $
 * $Date: $
 * $Id: $
 * $HeadURL: $
 *
 * Copyright (c) C.I.S.S - Tous droits réservés
 *
 */

namespace MeetupBundle\DataFixtures\ORM;

use MeetupBundle\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use MeetupBundle\Entity\Category;

class Fixturese extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        for($i = 0; $i < 20; $i++){
            $date = new \DateTime("now");
            $article = new Article();
            $article->setName("article". $i);
            $article->setAuthor("Author" .$i);
            $article->setContent("Lorem Ipsum " . $i);
            $article->setCreated($date);
            $article->setUpdated($date);
            $article->setPublished($date);

            $manager->persist($article);

        }

        for($i = 0; $i < 20; $i++){
            $date = new \DateTime("now");
            $category = new Category();
            $category->setName("cat_" . $i);
            $category->setOrdre($i);
            $category->setCreated($date);


            $manager->persist($category);

        }

        $manager->flush();
    }
}