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

    private function validateVariables(array $variables): void
    {
        foreach ($variables as $value) {
            if (is_array($value)) {
                $this->validateVariables($value);
            } elseif (!is_scalar($value)) {
                throw new \InvalidArgumentException('All values should be scalar or arrays recursively.');
            }
        }
    }

    public function sendTransactionalEmail(
        string $to, string $transactionalAlias, string $templateAlias, array $variables
    ): void {
        $this->validateVariables($variables);

        $data = [
            'to' => $to,
            'transactional_alias' => $transactionalAlias,
            'template_alias' => $templateAlias,
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
