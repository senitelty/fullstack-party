<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class IssueController
 * @package App\Controller
 *
 * @Route("/issue")
 */
class IssueController extends Controller
{

    /**
     * @Route("/{owner}/{repo}/{number}", requirements={"owner": "\S+", "repo": "\S+", "number": "\d+"})
     *
     * @param string $owner
     * @param string $repo
     * @param int $number
     *
     * @return Response
     * @throws NotFoundHttpException
     */
    public function viewIssue(string $owner, string $repo, int $number)
    {
        $dataManager = $this->get("app.github.data_manager");

        return $this->render(
            "issue/issue.html.twig",
            [
                "issue" => $dataManager->getSingleIssue($owner, $repo, $number),
                "comments" => $dataManager->getIssueComments($owner, $repo, $number),
            ]
        );
    }
}
