<?php

namespace App\Controller;

use App\Entity\Issue;
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
     * @Route("/project_issues/{id}", name="project_issues")
     * @return Response
     */
    public function getProjectIssues(ApiRequestManager $apiRequestManager, SerializerInterface $serializer, $id)
    {
        $marker = 'project_id';
        $request = $apiRequestManager->requestApi('issues.json', $marker, $id );

        if (!$request) {
            throw $this->createNotFoundException(
                'No issues found' );
        }
        $issues = $serializer->deserialize(
            $request,
            Issue::class,
            'json',
            []
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

        $request = $apiRequestManager->requestApi('issues/'.$id.'.json');

        if (!$request) {
            throw $this->createNotFoundException(
                'No issues found');
        }
        $issue = $serializer->deserialize(
            $request,
            Issue::class,
            'json',
            []
        );

        return $this->render('issue.html.twig', array(
            'issue' => $issue,
        ));

    }


}