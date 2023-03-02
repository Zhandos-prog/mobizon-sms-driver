<?php

declare(strict_types=1);

namespace ZhandosProg\MobizonSmsDriver\Driver;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;
use Tzsk\Sms\Contracts\Driver;

class MobizonDriver extends Driver
{

    protected Client $httpClient;

    public function boot(): void
    {
        $this->httpClient = new Client();
    }

    public function send(): Collection
    {
        /** @var \Illuminate\Support\Collection $response */
        $response = collect();

        foreach ($this->recipients as $recipient) {
            $this->httpClient->request(
                'POST',
                $this->settings['url'].'service/message/sendsmsmessage',
                [
                    'query'=>[
                        'apiKey' => $this->settings['apiKey']
                    ],
                    $this->payload($recipient),
                ],
            );
        }

        return (count($this->recipients) == 1) ? $response->first() : $response;
    }

    private function payload(string $recipient): array
    {
        return [
            'recipient' => $recipient,
            'from' => $this->settings['from'],
            'text' => $this->body,
        ];
    }
}