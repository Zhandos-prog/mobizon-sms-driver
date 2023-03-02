<?php

declare(strict_types=1);

namespace ZhandosProg\MobizonSmsDriver;

use Illuminate\Support\Collection;
use Tzsk\Sms\Facades\Sms;
use ZhandosProg\MobizonSmsDriver\Exception\PhoneNumberValidationException;

class MobizonSenderSMS implements MobizonSenderSMSInterface
{

    public function send(array $phoneNumbers, string $message): Collection
    {
        $validPhoneNumbers = [];

        foreach ($phoneNumbers as $phoneNumber) {

            if (!preg_match('/^77\d{9}$/', $phoneNumber)) {
                throw new PhoneNumberValidationException('Phone number is invalid');
            }

            $validPhoneNumbers[] = $phoneNumber;
        }

        return Sms::via('smsmobizon')->send($message)->to([$validPhoneNumbers])->dispatch();
    }
}