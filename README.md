# Dokobit WS API PHP Client

[![Code Coverage](https://scrutinizer-ci.com/g/dokobit/ws-api-sdk-php/badges/coverage.png?b=2.0)](https://scrutinizer-ci.com/g/dokobit/ws-api-sdk-php/?branch=2.0)
[![Build Status](https://scrutinizer-ci.com/g/dokobit/ws-api-sdk-php/badges/build.png?b=2.0)](https://scrutinizer-ci.com/g/dokobit/ws-api-sdk-php/build-status/2.0)

## How to start?

Check integration tests under `tests/Integration` for library use cases.

## Logging requests

### Custom PSR-3 logger

    use GuzzleHttp\Middleware;
    use GuzzleHttp\MessageFormatter;
    use Monolog\Logger;

    $log = Middleware::log(new Logger('requests'), new MessageFormatter(MessageFormatter::DEBUG));

    $client = Dokobit\Client::create([
        'apiKey' => 'xxxxxx',
        'sandbox' => true,
    ], $log);

Read more:

http://www.php-fig.org/psr/psr-3/

https://github.com/Seldaek/monolog


## Debugging

To dig more into occured error use following methods. A

    echo (string) $exception->getMessage()
    echo (string) $exception->getPrevious()->getResponse()
    var_dump( $exception->getResponseData() )

Available on all exception classes except `UnexpectedError` and `QueryValidator`.

## Develop

Whole testsuite including integrational tests

    phpunit

Don't forget to define `SANDBOX_API_KEY` in your phpunit.xml.


Running unit tests only:

    phpunit --testsuite=Unit

Running integrational tests only:
    
    phpunit --testsuite=Integration

Running single testcase:

    phpunit tests/Integration/MobileSignTest.php
