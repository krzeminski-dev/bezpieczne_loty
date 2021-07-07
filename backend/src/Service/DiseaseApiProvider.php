<?php

namespace App\Service;

use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DiseaseApiProvider
{
    /**
     * @var HttpClientInterface
     */
    private $client;
    /**
     * @var LoggerInterface
     */
    private $logger;

    private const URL = 'https://disease.sh/v3/';

    public function __construct(HttpClientInterface $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    public function getCountries(): ?array
    {
        try {
            $response = $this->client->request('GET', self::URL . 'covid-19/countries');
        } catch (TransportExceptionInterface $e) {
            $this->logger->error($e->getMessage());
            $response = null;
        }

        return json_decode($response->getContent());
    }
}