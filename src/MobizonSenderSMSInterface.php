<?php

declare(strict_types=1);

namespace ZhandosProg\MobizonSmsDriver;

use Illuminate\Support\Collection;

interface MobizonSenderSMSInterface
{

    public function send(array $phoneNumbers, string $message): Collection;
}