<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Topic;
use AppBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;

/**
 * Class PostController
 * @package AppBundle\Controller
 * @Route("/forum/{forum_id}/topic/{topic_id}/post",requirements={"forum_id"="\d+","topic_id":"\d+"})
 */
class PostController extends Controller
{

    /**
     * @Route("/add")
     */
    public function addAction(int $forum_id, int $topic_id, Request $request)
    {
        $topic = $this->getDoctrine()
            ->getRepository(Topic::class)
            ->find($topic_id);
        if($request->isMethod('post')) {
            $post = new Post();

            $post->setCreation(new \DateTime());
            $post->setAuthor($request->get('author'));
            $post->setContent($request->get('content'));
            $post->setTopic($topic);

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('app_topic_show', [
                'id' => $topic->getId(),
                'forum_id' => $forum_id
            ]);
        }
        return $this->render('AppBundle:Post:add.html.twig', array(
            'topic'=>$topic
        ));
    }

    /**
     * @Route("/remove/{id}",requirements={"id"="\d+"},  name = "app_post_remove")
     */
    public function removeAction(int $forum_id, int $topic_id, int $id)
    {
        $post = $this->getDoctrine()
                ->getRepository(Post::class)
                ->find($id);
        $em = $this->getDoctrine()->getManager();
        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('app_topic_show', [
            'forum_id' => $forum_id,
            'id' => $topic_id
        ]);
    }

}
