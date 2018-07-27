<?php

namespace App\Model\Github;

use JMS\Serializer\Annotation as JMS;

class Issue
{
    public const STATE_OPEN = 'open';
    public const STATE_CLOSED = 'closed';
    public const STATE_ALL = 'all';

    /**
     * @var int
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("number")
     */
    private $number;

    /**
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("title")
     */
    private $title;

    /**
     * @var int
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("comments")
     */
    private $comments;

    /**
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("state")
     */
    private $state;

    /**
     * @var GithubUser
     *
     * @JMS\Type("array<App\Model\Github\GithubUser>")
     * @JMS\SerializedName("assignees")
     */
    private $assigness;

    /**
     * @var GithubUser
     *
     * @JMS\Type("App\Model\Github\GithubUser")
     * @JMS\SerializedName("user")
     */
    private $user;

    /**
     * @var Repository
     *
     * @JMS\Type("App\Model\Github\Repository")
     * @JMS\SerializedName("repository")
     */
    private $repository;

    /**
     * @var Label[]
     *
     * @JMS\Type("array<App\Model\Github\Label>")
     * @JMS\SerializedName("labels")
     */
    private $labels;

    /**
     * @var \DateTime
     *
     * @JMS\Type("DateTime")
     * @JMS\SerializedName("created_at")
     */
    private $createdAt;

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getComments(): int
    {
        return $this->comments;
    }

    /**
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * @return bool
     */
    public function isOpen(): bool
    {
        return $this->getState() == self::STATE_OPEN;
    }

    /**
     * @return bool
     */
    public function isClosed(): bool
    {
        return $this->getState() == self::STATE_CLOSED;
    }

    /**
     * @return GithubUser
     */
    public function getUser(): GithubUser
    {
        return $this->user;
    }

    /**
     * @return Repository
     */
    public function getRepository(): Repository
    {
        return $this->repository;
    }

    /**
     * @return Label[]
     */
    public function getLabels(): array
    {
        return $this->labels;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return GithubUser
     */
    public function getAssigness(): GithubUser
    {
        return $this->assigness;
    }
}
