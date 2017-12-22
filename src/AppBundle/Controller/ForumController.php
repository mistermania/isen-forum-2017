<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Forum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/forum")
 */
class ForumController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('AppBundle:Forum:index.html.twig', array(
            'forums' => $this->getDoctrine()
                ->getRepository(Forum::class)
                ->findAll()

        ));
    }

    /**
     * @Route("/add")
     */
    public function addAction(Request $request)
    {
        if($request->isMethod('post')){
            //create the forum
            $forum = new Forum();
            $forum->setTitle($request->get('title'));
            $forum->setDescription($request->get('description'));

            //get the manager
            $em = $this->getDoctrine()->getManager();

            //persist the new forum
            $em->persist($forum);

            // and flush entity manager
            $em->flush();
            return $this->redirectToRoute('app_forum_index');

        }
            return $this->render('AppBundle:Forum:add.html.twig', array(
                // no data required
        ));
    }

    /**
     * @Route("/{id}", requirements={"id": "\d+"})
     */
    public function showAction(int $id)
    {
        return $this->render('AppBundle:Forum:show.html.twig', array(
            'forum' => $this->getDoctrine()
                ->getRepository(Forum::class)
                ->find($id)
        ));
    }

}
