<?php
namespace Dokobit\Tests\Sign;

use Dokobit\QueryInterface;
use Dokobit\Sign\MobileStatusResult;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class MobileStatusResultTest extends TestCase
{
    private $method;
    
    public function setUp(): void
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
