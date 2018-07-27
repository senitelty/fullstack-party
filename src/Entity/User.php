<?php

namespace App\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class User
 * @package App\Entity
 * @ORM\Table(name="users")
 * @ORM\Entity
 */
class User extends BaseUser
{
    /**
     * @var string $id
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="bigint")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="github_id", type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $githubId;

    /**
     * @ORM\Column(name="google_id", type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $googleId;

    /**
     * @ORM\Column(name="github_access_token", type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $githubAccessToken;


    /**
     * @ORM\Column(name="google_access_token", type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $googleAccessToken;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getGithubId(): string
    {
        return $this->githubId;
    }

    /**
     * @param string $github_id
     * @return User
     */
    public function setGithubId(string $githubId): User
    {
        $this->githubId = $githubId;

        return $this;
    }

    /**
     * @return string
     */
    public function getGoogleId(): string
    {
        return $this->googleId;
    }

    /**
     * @param string $googleId
     * @return User
     */
    public function setGoogleId(string $googleId): User
    {
        $this->googleId = $googleId;

        return $this;
    }

    /**
     * @return string
     */
    public function getGithubAccessToken(): string
    {
        return $this->githubAccessToken;
    }

    /**
     * @param string $githubAccessToken
     * @return User
     */
    public function setGithubAccessToken(string $githubAccessToken): User
    {
        $this->githubAccessToken = $githubAccessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getGoogleAccessToken(): string
    {
        return $this->googleAccessToken;
    }

    /**
     * @param string $googleAccessToken
     * @return User
     */
    public function setGoogleAccessToken(string $googleAccessToken): User
    {
        $this->googleAccessToken = $googleAccessToken;

        return $this;
    }
}
