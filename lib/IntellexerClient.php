<?php

namespace EffectiveSoft\Intellexer;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

class IntellexerClient implements LoggerAwareInterface
{
    /** @var string */
    protected $baseUrl = 'http://api.intellexer.com/';

    /** @var string */
    protected $apiKey;

    /** @var Client */
    protected $client;

    /** @var HandlerStack */
    protected $stack;

    /** @var LoggerInterface */
    protected $logger;

    /** @var int */
    protected $timeout = 2;

    /**
     * @param string $apiKey
     * @param string $baseUrl
     */
    public function __construct($apiKey, $baseUrl = 'http://api.intellexer.com/')
    {
        $this->apiKey = $apiKey;
        $this->baseUrl = $baseUrl;
        $this->stack = HandlerStack::create();
        $this->client = new Client([
            'base_uri' => $baseUrl,
            'handler' => $this->stack,
        ]);
    }

    /**
     * @return $this
     *
     * {@inheritDoc}
     */
    public function setLogger(LoggerInterface $logger, MessageFormatter $messageFormatter = null)
    {
        if (!$messageFormatter) {
            $messageFormatter = new \EffectiveSoft\Intellexer\MessageFormatter('{{method}} - {target} - {res_body}');
        }

        $this->stack->remove('logger');
        $this->stack->push(
            Middleware::log($logger, $messageFormatter),
            'logger'
        );

        $this->logger = $logger;

        return $this;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger ?: new NullLogger();
    }

    /**
     * @param int $timeout
     *
     * @return $this
     */
    public function setTimeout($timeout = 2)
    {
        $this->timeout = intval($timeout) ?: 2;

        return $this;
    }

    /**
     * @param string $url
     * @param array $query
     *
     * @return array|null
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function get($url, array $query = [])
    {
        return $this->request('GET', $url, ['query' => $query]);
    }

    /**
     * @param string $url
     * @param string $body
     * @param array $query
     *
     * @return array|null
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function post($url, $body = '', array $query = [])
    {
        return $this->request('POST', $url, [
            'query' => $query,
            'body' => $body,
        ]);
    }

    /**
     * @param string $url
     * @param array $query
     * @param array $multipart
     *
     * @return array|null
     *
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function upload($url, array $multipart = [], array $query = [])
    {
        return $this->request('POST', $url, [
            'query' => $query,
            'multipart' => $multipart,
        ]);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     *
     * @return array|null
     */
    protected function request($method, $uri = '', array $options = [])
    {
        $options = array_merge_recursive($options, [
            'headers' => [
                'Accept' => 'application/json',
                'Cache-Control' => 'no-cache',
            ],
            'query' => ['apikey' => $this->apiKey,],
            'timeout' => $this->timeout,
        ]);

        $response = $this->client->request($method, $uri, $options);

        if ($response->getStatusCode() == 200) {
            $response->getBody()->rewind();

            return \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
        } else {
            return null;
        }
    }
}
