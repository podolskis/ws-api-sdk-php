<?php
namespace Dokobit\Tests\Sign;

use Dokobit\Document\SealResult;
use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

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
