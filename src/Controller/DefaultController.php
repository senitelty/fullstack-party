<?php

namespace App\Controller;

use App\Model\Github\Issue;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 *
 * @Route("/")
 */
class DefaultController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     * @Route("/")
     */
    public function dashboard(Request $request)
    {
        $user = $this->getUser();
        if ($user) {
            return $this->getDashboard($request);
        }

        return $this->render('login.html.twig');
    }

    private function getDashboard(Request $request)
    {
        $githubDataManager = $this->get('app.github.data_manager');

        $open = $githubDataManager->getIssueCountByState(Issue::STATE_OPEN);
        $closed = $githubDataManager->getIssueCountByState(Issue::STATE_CLOSED);
        $page = $request->query->get('page');
        $issuePager = $githubDataManager->getIssues($page ?? 1);

        return $this->render(
            'issue/list/index.html.twig',
            [
                'issues' => $issuePager->getIssues(),
                'openCount' => $open,
                'closedCount' => $closed,
                'pagination' => [
                    'maxPage' => $issuePager->getLastPage(),
                    'currentPage' => $issuePager->getCurrentPage(),
                    'pageButtons' => 2,
                ],
            ]
        );
    }
}
