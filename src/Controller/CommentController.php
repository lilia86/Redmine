<?php

namespace App\Controller;

use App\Entity\Comment;

use App\Form\CommentType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


class CommentController extends Controller
{
    /**
     * @param integer $id
     * @Route("/projects/comment_show/{id}", name="project_comments", requirements={"id"="\d+"})
     * @return Response
     */
    public function getProjectComments($id)
    {
        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->findByProject($id);

        if (!$comments) {
            throw $this->createNotFoundException(
                'No comments found '
            );
        }

        return $this->render('list_comments.html.twig', array(
            'comments' => $comments,
        ));
    }


    /**
     * @param Request $request
     * @param integer $id
     * @Route("/projects/comment_add/{id}", name="add_comment", requirements={"id"="\d+"})
     * @return Response
     */
    public function addComment(Request $request, $id)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setUser($this->getUser()->getUserName());
            $comment->setProject($id);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

            return $this->redirectToRoute('projects');
        }

        return $this->render('form.html.twig', array(
            'form' => $form->createView(),
        ));

    }
}