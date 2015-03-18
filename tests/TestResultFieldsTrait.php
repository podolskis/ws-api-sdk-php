<?php
namespace Isign\Tests;

trait TestResultFieldsTrait
{
    /**
     * @dataProvider expectedFields
     */
    public function testGetFields($name)
    {
        $result = $this->method->getFields();

        $this->assertContains($name, $result);
    }

    /**
     * @dataProvider expectedFields
     */
    public function testSettersAndGetters($name)
    {
        $this->assertSetterExists($name, $this->method);
        $this->assertGetterExists($name, $this->method);
    }
}
