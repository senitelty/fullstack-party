<?php

namespace App\Model\Github;

use JMS\Serializer\Annotation as JMS;

class GithubUser
{
    /**
     * @var int
     *
     * @JMS\Type("integer")
     * @JMS\SerializedName("id")
     */
    private $id;

    /**
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("login")
     */
    private $username;

    /**
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("avatar_url")
     */
    private $avatarUrl;

    /**
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("url")
     */
    private $userUrl;

    /**
     * @var string
     *
     * @JMS\Type("string")
     * @JMS\SerializedName("type")
     */
    private $userType;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getAvatarUrl(): string
    {
        return $this->avatarUrl;
    }

    /**
     * @return string
     */
    public function getUserUrl(): string
    {
        return $this->userUrl;
    }

    /**
     * @return string
     */
    public function getUserType(): string
    {
        return $this->userType;
    }
}
