<?php
namespace Dokobit\Tests\Login;

use Dokobit\Login\MobileResult;
use Dokobit\QueryInterface;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class MobileResultTest extends TestCase
{
    private $method;

    public function setUp()
    {
        $this->method = new MobileResult();
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['control_code'],
            ['token'],
            ['name'],
            ['surname'],
            ['code'],
            ['country'],
            ['certificate'],
        ];
    }
}
