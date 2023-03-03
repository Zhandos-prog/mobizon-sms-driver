<?php

declare(strict_types=1);

namespace ZhandosProg\MobizonSmsDriver;

use Illuminate\Support\ServiceProvider;

class MobizonServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            MobizonSenderSMSInterface::class,
            MobizonSenderSMS::class
        );
    }
}