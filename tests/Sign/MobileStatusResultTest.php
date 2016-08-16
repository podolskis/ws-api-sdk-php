<?php
namespace Isign\Tests\Sign;

use Isign\QueryInterface;
use Isign\Sign\MobileStatusResult;
use Isign\Tests\TestCase;
use Isign\Tests\TestResultFieldsTrait;

class MobileStatusResultTest extends TestCase
{
    private $method;
    
    public function setUp()
    {
        $this->method = new MobileStatusResult();
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['file'],
        ];
    }
}
