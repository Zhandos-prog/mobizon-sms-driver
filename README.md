# Mobizon SMS Driver for [Laravel SMS Gateway](https://github.com/tzsk/sms)

- [Requirements](#requirements)
- [Features](#features)
- [Installation](#installation)
- [Configure](#configure)
- [Usage](#usage)
- [Exceptions](#exceptions)

## Requirements

- PHP >= 8.0
- [Laravel SMS Gateway](https://github.com/tzsk/sms)

## Features

- [&check;] Send sms single
- [&check;] Send sms mass

## Installation

```bash
composer require zhandos-prog/mobizon-sms-driver
```

## Configure

Publish the config file

```bash
$ php artisan sms:publish
```

In the config file you can set the default driver to use for all your SMS. But you can also change the driver at
runtime.

Choose what gateway you would like to use for your application. Then make that as default driver so that you don't have
to specify that everywhere. But, you can also use multiple gateways in a project.

#### Path config file: app/config/sms.php

```php
// Eg. if you want to use MobizonSmsDriver.
'default' => 'smsmobizon',
```
Then fill the credentials for that gateway in the `drivers` array.

```php
// Eg. for MobizonSmsDriver.
'drivers' => [
    'smsmobizon' => [
        // Fill all the credentials here.
        'apiKey' => 'Your Api Key',
        'from' => 'Your Mobizon Sender ID',
    ],
    ...
]
```

Сlass MobizonSmsDriver needs to be mapped specify it in the `map` section
```php
// Eg. for MobizonSmsDriver.
'map' => [
    ...
    'smsmobizon' => ZhandosProg\MobizonSmsDriver\Driver\MobizonDriver::class,
]
```

Register a service provider
#### Path config file: app/config/app.php
```php
// Eg. for MobizonSmsDriver.
'providers' => [
    ...
    ZhandosProg\MobizonSmsDriver\MobizonServiceProvider::class,
]
```

## Usage
In your code just use it like this.

```php
use ZhandosProg\MobizonSmsDriver\MobizonSenderSMSInterface;

Class ExampleController {
    
    private MobizonSenderSMSInterface $mobizonSenderSMS;
    
    public function __construct(MobizonSenderSMSInterface $mobizonSenderSMS)
    {
        $this->mobizonSenderSMS = $mobizonSenderSMS
    }
    
    public function single()
    {
        /// ... your logic
       
        $response = $this->mobizonSenderSMS->send('77779998877', '42')
        dd($response);
        
        /// ... your logic
    }
    
    public function mass()
    {
        /// ... your logic
       
        $response = $this->mobizonSenderSMS->send(['77773335566','87774444242'], '42')
        dd($response);
        
        /// ... your logic
    }
}

```

You can also use a package facade [Laravel SMS Gateway](https://github.com/tzsk/sms). All details in **Usage** section!
#### if you use a facade [Laravel SMS Gateway](https://github.com/tzsk/sms), then registering the service provider is not necessary!

## Exceptions

- ``PhoneNumberValidationException``
