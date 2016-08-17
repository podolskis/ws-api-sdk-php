<?php
namespace Isign\Tests\Login;

use Isign\Login\MobileResult;
use Isign\QueryInterface;
use Isign\Tests\TestCase;
use Isign\Tests\TestResultFieldsTrait;

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
