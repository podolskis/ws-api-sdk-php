<?php
namespace Isign\Tests\Exception;

use Isign\Exception\QueryValidator;
use Symfony\Component\Validator\ConstraintViolationList;

class QueryValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetResponseData()
    {
        $message = 'Message';
        $violations = $this->getMockBuilder('Symfony\Component\Validator\ConstraintViolationList')
            ->disableOriginalConstructor()
            ->getMock();

        $object = new QueryValidator($message, $violations);

        $this->assertEquals($violations, $object->getViolations());
        $this->assertEquals($message, $object->getMessage());
    }
}
