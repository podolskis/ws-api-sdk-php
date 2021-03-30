<?php
namespace Sign;

use Dokobit\Sign\ScResult;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class ScResultTest extends TestCase
{
    private $method;

    public function setUp()
    {
        $this->method = new ScResult();
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['file'],
            ['signature_id']
        ];
    }
}
