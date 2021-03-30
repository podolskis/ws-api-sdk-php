<?php
namespace Dokobit\Tests\Login;

use Dokobit\Login\SmartIdResult;
use Dokobit\QueryInterface;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class SmartIdResultTest extends TestCase
{
    private $method;

    public function setUp()
    {
        $this->method = new SmartIdResult();
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['token'],
            ['control_code'],
        ];
    }
}
