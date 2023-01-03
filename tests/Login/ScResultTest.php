<?php


namespace Dokobit\Login;

use Dokobit\Tests\TestCase;
use Dokobit\Tests\TestResultFieldsTrait;

class ScResultTest extends TestCase
{
    private $method;

    public function setUp(): void
    {
        $this->method = new ScResult();
    }

    use TestResultFieldsTrait;

    public function expectedFields()
    {
        return [
            ['status'],
            ['dtbs'],
            ['token'],
            ['name'],
            ['surname'],
            ['code'],
            ['country'],
            ['certificate'],
            ['algorithm'],
        ];
    }
}
