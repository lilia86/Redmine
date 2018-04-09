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
        $requestApi = $apiRequestManager->requestApi('projects.json');

        if (!$requestApi) {
            throw $this->createNotFoundException(
                'No projects found' );
        }

       $projects = $serializer->deserialize(
            $requestApi,
            Project::class,
            'json',
           []
        );

        $paginator  = $this->get('knp_paginator');
        $projects = $paginator->paginate(
            $projects,
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
        $request = $apiRequestManager->requestApi('projects/' . $id . '.json');

        if (!$request) {
            throw $this->createNotFoundException(
                'No projects found');
        }
        $project = $serializer->deserialize(
            $request,
            Project::class,
            'json'
        );

        $marker = 'project_id';
        $spentTime = $timeTrackManager->spentTime($marker, $id);

        return $this->render('project.html.twig', array(
            'project' => $project, 'spent_time' => $spentTime,
        ));

    }

}