<?php
namespace Dokobit\Tests\Sign;

use Dokobit\QueryInterface;
use Dokobit\Sign\MobileHashStatusResult;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class MobileHashStatusResultTest extends TestCase
{
    private $method;
    
    public function setUp(): void
    {
        $this->method = new MobileHashStatusResult();
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['signature_value'],
        ];
    }
}
