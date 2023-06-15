<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiAdressGouv
{
    private $client;

    public function __construct(HttpClientInterface $client) {
        $this->client = $client;
    }

    public function getAdress($adresse) : array
    {
        $response = $this->client->request(
            'GET',
            'https://api-adresse.data.gouv.fr/search/?q=' . $adresse
        );

        return $response->toArray();
    }
}
