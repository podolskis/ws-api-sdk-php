<?php
namespace Sign;

use Isign\Sign\ScResult;
use Isign\Tests\TestCase;
use Isign\Tests\TestResultFieldsTrait;

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
