<?php
namespace Isign\Tests\Sign;

use Isign\QueryInterface;
use Isign\Sign\MobileResult;
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
            ['controlCode'],
            ['token']
        ];
    }
}
