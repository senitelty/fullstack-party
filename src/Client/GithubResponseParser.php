<?php

namespace App\Client;

use JMS\Serializer\SerializerInterface;
use Psr\Http\Message\ResponseInterface;

class GithubResponseParser
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param ResponseInterface $response
     * @param string|null $deserializationType
     * @return mixed
     */
    public function getContent(ResponseInterface $response, string $deserializationType = null)
    {
        if (strpos($response->getHeaderLine('Content-Type'), 'application/json') === 0) {
            $body = (string)$response->getBody();
            if (null === $deserializationType) {
                return \GuzzleHttp\json_decode($body, true);
            }

            return $this->serializer->deserialize($body, $deserializationType, 'json');
        }

        throw new \InvalidArgumentException('Response content must be type of json');
    }

    /**
     * @param ResponseInterface $response
     * @return int
     */
    public function getTotalPagesCount(ResponseInterface $response): ?int
    {
        $paginationData = $this->getPaginationData($response);
        if (!isset($paginationData['last'])) {
            return 1;
        }

        $query = parse_url($paginationData['last'], PHP_URL_QUERY);
        parse_str($query, $parsedQuery);

        return isset($parsedQuery['page']) ? $parsedQuery['page'] : null;
    }

    /**
     * @param ResponseInterface $response
     * @return array
     */
    public function getPaginationData(ResponseInterface $response): array
    {
        if (!$response->hasHeader('Link')) return [];

        $header = $this->getHeader($response, 'Link');
        $pagination = [];
        foreach (explode(',', $header) as $link) {
            preg_match('/<(.*)>; rel="(.*)"/i', trim($link, ','), $match);

            if (count($match) === 3) {
                $pagination[$match[2]] = $match[1];
            }
        }

        return $pagination;
    }


    /**
     * @param ResponseInterface $response
     * @param string $name
     * @return string|null
     */
    public function getHeader(ResponseInterface $response, string $name): ?string
    {
        $headers = $response->getHeader($name);

        return array_shift($headers);
    }
}
