<?php

namespace App\Controller;

use App\Entity\Issue;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Service\ApiRequestManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class IssueController extends Controller
{
    /**
     * @param ApiRequestManager $apiRequestManager
     * @param SerializerInterface $serializer
     * @param integer $id
     * @param Request $request
     * @Route("/project_issues/{id}", name="project_issues")
     * @return Response
     */
    public function getProjectIssues(ApiRequestManager $apiRequestManager, SerializerInterface $serializer, Request $request, $id)
    {
        $marker = 'project_id';
        $requestApi = $apiRequestManager->requestApi('issues.json', Issue::class, $marker, $id);

        if (!$requestApi) {
            throw $this->createNotFoundException(
                'No issues found' );
        }

        $paginator  = $this->get('knp_paginator');
        $issues = $paginator->paginate(
            $requestApi,
            $request->query->getInt('page', 1),
            5
        );
        return $this->render('list_issues.html.twig', array(
            'issues' => $issues,
        ));
    }


    /**
     * @param ApiRequestManager $apiRequestManager
     * @param SerializerInterface $serializer
     * @param integer $id
     * @Route("/issues/{id}", name="issue", requirements={"id"="\d+"})
     * @return Response
     */
    public function getIssueById(ApiRequestManager $apiRequestManager, SerializerInterface $serializer,
                                 $id)
    {

        $request = $apiRequestManager->requestApi('issues/'.$id.'.json', Issue::class);

        if (!$request) {
            throw $this->createNotFoundException(
                'No issues found');
        }

        return $this->render('issue.html.twig', array(
            'issue' => $request,
        ));

    }


}