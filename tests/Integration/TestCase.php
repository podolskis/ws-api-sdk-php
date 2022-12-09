<?php
namespace Dokobit\Tests\Integration;

use Dokobit\Client;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Base test case
 */
class TestCase extends \PHPUnit\Framework\TestCase
{
    /** @var Client */
    protected $client;

    public function setUp(): void
    {
        $params = [
            'apiKey' => SANDBOX_API_KEY,
            'sandbox' => true,
        ];

        if (defined('SANDBOX_URL')) {
            $params['sandboxUrl'] = SANDBOX_URL;
        }

        $log = false;
        // Uncomment to enable request/response debugging
        // $log = null;

        $this->client = Client::create($params, $log);
    }

    protected function sign($dtbs, $key)
    {
        openssl_sign(base64_decode($dtbs), $signatureValue, $key, OPENSSL_ALGO_SHA256);

        return base64_encode($signatureValue);
    }
}
