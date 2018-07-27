<?php

namespace App\Manager;


use App\Client\GithubResponseParser;
use App\Model\Github\Comment;
use App\Model\Github\Issue;
use App\Model\Github\IssuePager;
use App\Repository\GithubRepository;
use Psr\Http\Message\ResponseInterface;

class GithubDataManager
{

    private $githubRepository;

    private $githubResponseParser;

    public function __construct(GithubRepository $githubRepository, GithubResponseParser $githubResponseParser)
    {
        $this->githubRepository = $githubRepository;
        $this->githubResponseParser = $githubResponseParser;
    }

    /**
     * @param ResponseInterface $response
     * @param string|null $deserializationType
     * @return mixed
     */
    protected function parseResponse(ResponseInterface $response, string $deserializationType = null)
    {
        return $this->githubResponseParser->getContent($response, $deserializationType);
    }


    /**
     * @param int $page
     * @return IssuePager
     */
    public function getIssues(int $page = 1)
    {
        $response = $this->githubRepository->getPaginatedIssuesResponse($page, 5, Issue::STATE_ALL);
        $content = $this->parseResponse($response, sprintf('array<%s>', Issue::class));
        $totalPages = $this->githubResponseParser->getTotalPagesCount($response);
        $pager = (new IssuePager())
            ->setIssues($content)
            ->setLastPage($totalPages)
            ->setItemsPerPage(5)
            ->setCurrentPage($page > $totalPages ? $totalPages : $page)
        ;

        return $pager;
    }

    /**
     * @param string $state
     * @return int
     */
    public function getIssueCountByState(string $state): int
    {
        $response = $this->githubRepository->getPaginatedIssuesResponse(1, 1, $state);
        $totalPages = $this->githubResponseParser->getTotalPagesCount($response);
        if ($totalPages > 1) {
            return $totalPages;
        }

        return count($this->parseResponse($response));
    }

    /**
     * @param string $owner
     * @param string $repo
     * @param int $number
     * @return array|Comment[]
     */
    public function getIssueComments(string $owner, string $repo, int $number)
    {
        $response = $this->githubRepository->getIssueCommentsResponse($owner, $repo, $number);

        return $this->parseResponse($response, sprintf('array<%s>', Comment::class));
    }

    /**
     * @param string $owner
     * @param string $repo
     * @param int $number
     * @return Issue
     */
    public function getSingleIssue(string $owner, string $repo, int $number): Issue
    {
        $response = $this->githubRepository->getSingleIssueResponse($owner, $repo, $number);

        return $this->parseResponse($response, Issue::class);
    }
}
