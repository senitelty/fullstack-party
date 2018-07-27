<?php

namespace App\Factory;

use App\Client\GithubClient;
use App\Entity\User;
use GuzzleHttp\Client;
use GuzzleHttp\Command\Guzzle\Description;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Monolog\Logger;
use Psr\Http\Message\RequestInterface;
use GuzzleHttp\HandlerStack;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class GithubClientFactory
{
    /** @var TokenStorage */
    private $tokenStorage;

    /**
     * @param Description $description
     * @param TokenStorage $tokenStorage
     * @param string $cacheDir
     * @return GithubClient
     */
    public function create(Description $description, TokenStorage $tokenStorage, string $cacheDir): GithubClient
    {
        $this->tokenStorage = $tokenStorage;
        $stack = HandlerStack::create();
        $stack->push($this->getMapRequestMiddleware($this->getUser()->getGithubAccessToken()), 'map_request');
        $stack->push(
            Middleware::log(
                new Logger('Logger'),
                new MessageFormatter()
            )
        );

        return new GithubClient(
            new Client(['handler' => $stack]),
            $description,
            null,
            null,
            null,
            ['process' => false]
        );
    }

    /**
     * @param string $authToken
     * @return callable
     */
    protected function getMapRequestMiddleware(string $authToken): callable
    {
        return Middleware::mapRequest(
            function (RequestInterface $request) use ($authToken) {
                return $request->withHeader('Authorization', sprintf('token %s', $authToken));
            }
        );
    }

    /**
     * @return User|object
     */
    private function getUser(): User
    {
        $user = $this->tokenStorage->getToken()->getUser();

        return $user;
    }
}
