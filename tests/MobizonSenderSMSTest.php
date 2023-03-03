<?php

declare(strict_types=1);

namespace ZhandosProg\WriteSpelling;

use PHPUnit\Framework\TestCase;
use ZhandosProg\MobizonSmsDriver\Exception\PhoneNumberValidationException;
use ZhandosProg\MobizonSmsDriver\MobizonSenderSMS;

class MobizonSenderSMSTest extends TestCase
{

    private const INVALID_PHONE_NUMBERS = ['+77778899090','87089008877'];

    private const MESSAGE = 'Confirmation code: 4242';

    public function testPhoneNumberValidationException(): void
    {
        $this->expectException(PhoneNumberValidationException::class);
        $this->expectExceptionMessage('Phone number is invalid');

        (new MobizonSenderSMS())->send([static::INVALID_PHONE_NUMBERS],static::MESSAGE);
    }
}
