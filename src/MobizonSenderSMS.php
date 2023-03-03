<?php

declare(strict_types=1);

namespace ZhandosProg\MobizonSmsDriver;

use Illuminate\Support\Collection;
use Tzsk\Sms\Facades\Sms;
use ZhandosProg\MobizonSmsDriver\Exception\PhoneNumberValidationException;

class MobizonSenderSMS implements MobizonSenderSMSInterface
{

    public function send(array|string $phoneNumber, string $message): Collection
    {
        $validPhoneNumber = [];

        if (is_array($phoneNumber)) {

            foreach ($phoneNumber as $number) {

                if (!preg_match('/^77\d{9}$/', $number)) {
                    throw new PhoneNumberValidationException('Phone number is invalid');
                }

                $validPhoneNumber[] = $phoneNumber;
            }
        }

        if (is_string($phoneNumber)) {

            if (!preg_match('/^77\d{9}$/', $phoneNumber)) {
                throw new PhoneNumberValidationException('Phone number is invalid');
            }

            $validPhoneNumber[] = $phoneNumber;
        }

        return Sms::via('smsmobizon')->send($message)->to($validPhoneNumber)->dispatch();
    }
}