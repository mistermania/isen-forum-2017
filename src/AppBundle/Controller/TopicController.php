<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/forum/{forum_id}/topic", requirements={"forum_id": "\d+"})
 */
class TopicController extends Controller
{
    /**
     * @Route("/{id}", requirements={"id": "\d+"})
     */
    public function indexAction(int $forum_id, int $id)
    {
        return $this->render('AppBundle:Topic:index.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/add")
     */
    public function addAction(int $forum_id)
    {
        return $this->render('AppBundle:Topic:add.html.twig', array(
            // ...
        ));
    }

}
