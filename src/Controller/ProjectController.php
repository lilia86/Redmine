<?php

namespace App\Controller;

use App\Entity\Project;
use App\Service\TimeTrackManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\ApiRequestManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends Controller
{
    /**
     * @param ApiRequestManager $apiRequestManager
     * @param SerializerInterface $serializer
     * @param Request $request
     * @Route("/projects", name="projects")
     * @return Response
     */
    public function getAll(ApiRequestManager $apiRequestManager, SerializerInterface $serializer, Request $request)
    {
        $requestApi = $apiRequestManager->requestApi('projects.json', Project::class);

        if (!$requestApi) {
            throw $this->createNotFoundException(
                'No projects found' );
        }

        $paginator  = $this->get('knp_paginator');
        $projects = $paginator->paginate(
            $requestApi,
            $request->query->getInt('page', 1),
            2
        );

        return $this->render('list_projects.html.twig', array(
            'projects' => $projects,
        ));
    }


    /**
     * @param ApiRequestManager $apiRequestManager
     * @param SerializerInterface $serializer
     * @param TimeTrackManager $timeTrackManager
     * @param integer $id
     * @Route("/projects/{id}", name="project", requirements={"id"="\d+"})
     * @return Response
     */
    public function getProjectById(ApiRequestManager $apiRequestManager,  SerializerInterface $serializer,
                                   TimeTrackManager $timeTrackManager, $id)
    {
        $request = $apiRequestManager->requestApi('projects/' . $id . '.json', Project::class);

        if (!$request) {
            throw $this->createNotFoundException(
                'No projects found');
        }

        $marker = 'project_id';
        $spentTime = $timeTrackManager->spentTime(Project::class, $marker, $id);

        return $this->render('project.html.twig', array(
            'project' => $request, 'spent_time' => $spentTime,
        ));

    }

}