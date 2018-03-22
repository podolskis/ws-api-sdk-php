<?php
namespace Isign\Tests\Sign;

use Isign\Document\SealResult;
use Isign\Tests\TestCase;
use Isign\Tests\TestResultFieldsTrait;

class SealResultTest extends TestCase
{
    private $method;

    public function setUp()
    {
        $this->method = new SealResult();
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['signature_id'],
            ['file']
        ];
    }
}
