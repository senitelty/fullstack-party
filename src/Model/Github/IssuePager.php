<?php

namespace App\Model\Github;


class IssuePager
{

    private $currentPage = 1;

    private $lastPage = 1;

    private $firstPage = 1;

    private $itemsPerPage = 1;

    /**
     * @var Issue[] $issues
     */
    private $issues;

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @param int $currentPage
     * @return IssuePager
     */
    public function setCurrentPage(int $currentPage): IssuePager
    {
        $this->currentPage = $currentPage;

        return $this;
    }

    /**
     * @return int
     */
    public function getLastPage(): int
    {
        return $this->lastPage;
    }

    /**
     * @param int $lastPage
     * @return IssuePager
     */
    public function setLastPage(int $lastPage): IssuePager
    {
        $this->lastPage = $lastPage;

        return $this;
    }

    /**
     * @return int
     */
    public function getItemsPerPage(): int
    {
        return $this->itemsPerPage;
    }

    /**
     * @param int $itemsPerPage
     * @return IssuePager
     */
    public function setItemsPerPage(int $itemsPerPage): IssuePager
    {
        $this->itemsPerPage = $itemsPerPage;

        return $this;
    }

    /**
     * @return int
     */
    public function getFirstPage(): int
    {
        return $this->firstPage;
    }

    /**
     * @param int $firstPage
     * @return IssuePager
     */
    public function setFirstPage(int $firstPage): IssuePager
    {
        $this->firstPage = $firstPage;

        return $this;
    }

    /**
     * @return Issue[]
     */
    public function getIssues(): array
    {
        return $this->issues;
    }

    /**
     * @param Issue[] $issues
     * @return IssuePager
     */
    public function setIssues(array $issues): IssuePager
    {
        $this->issues = $issues;

        return $this;
    }
}
