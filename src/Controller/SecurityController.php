<?php

namespace App\Controller;

use App\Entity\Project;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\ApiRequestManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Comment;
use Symfony\Component\Routing\Annotation\Route;



class SecurityController extends Controller
{
    /**
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @Route("/login", name="login")
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

        $error = $authenticationUtils->getLastAuthenticationError();


        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }

    /**
     * @param ApiRequestManager $apiRequestManager
     * @param SerializerInterface $serializer
     * @Route("/", name="home_page")
     * @return Response
     */
    public function getAll(ApiRequestManager $apiRequestManager, SerializerInterface $serializer)
    {
        $request = $apiRequestManager->requestApi('projects.json', Project::class,null, null, 5);

        if (!$request) {
            throw $this->createNotFoundException(
                'No projects found' );
        }

        $comments = $this->getDoctrine()
            ->getRepository(Comment::class)
            ->getAll(3);

        return $this->render('index.html.twig', array(
            'projects' => $request, 'comments' => $comments
        ));
    }



}