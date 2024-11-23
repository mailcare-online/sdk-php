<?php

namespace MailcareOnline;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class Mailcare
{
    private $apiToken;
    private $client;

    public function __construct(string $apiToken)
    {
        $this->apiToken = $apiToken;
        $this->client = new Client([
            'base_uri' => 'https://mailcare.online/api/v1/',
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiToken
            ]
        ]);
    }

    public function sendTransactionalEmail(string $to, string $transactionalUid, array $variables): void
    {
        foreach ($variables as $key => $value) {
            if (!is_scalar($value) && !is_array($value)) {
                throw new \InvalidArgumentException('All values should be scalar or arrays recursively.');
            }
        }

        $data = [
            'to' => $to,
            'transactional_uid' => $transactionalUid,
            'variables' => $variables
        ];

        try {
            $response = $this->client->post('transactional/', [
                'json' => $data,
            ]);
        } catch (RequestException $e) {
            throw new \RuntimeException('API call failed: ' . $e->getMessage());
        }
    }
}
