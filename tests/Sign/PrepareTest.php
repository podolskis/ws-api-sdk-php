<?php

namespace Isign\Tests\Sign;

use Isign\QueryInterface;
use Isign\Sign\ScPrepare;
use Isign\Tests\TestCase;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

class PrepareTest extends TestCase
{
    const TYPE = 'pdf';
    const TIMESTAMP = false;
    const LANGUAGE = 'LT';

    /** @var  Prepare */
    private $method;

    /** @var  Validation */
    private $validator;

    public function setUp()
    {
        $this->method = new ScPrepare(
            base64_encode(CERTIFICATE_SIGN),
            self::TYPE,
            self::TIMESTAMP,
            self::LANGUAGE,
            []
        );
        $this->validator = Validation::createValidator();
    }

    public function testGetFields()
    {
        $result = $this->method->getFields();

        $this->assertArrayHasKey('certificate', $result);
        $this->assertArrayHasKey('type', $result);
        $this->assertArrayHasKey('timestamp', $result);
        $this->assertArrayHasKey('language', $result);
        $this->assertArrayHasKey($result['type'], $result);
    }

    public function testGetAction()
    {
        $this->assertSame('sc/prepare', $this->method->getAction());
    }

    public function testGetMethod()
    {
        $this->assertSame(QueryInterface::POST, $this->method->getMethod());
    }

    public function testValidationConstraints()
    {
        $violations = $this->validator->validate(
            $this->method->getFields(),
            $this->method->getValidationConstraints()
        );

        $this->assertEquals(0, count($violations));
    }

    public function testTypeValidationConstraint()
    {
        $method = new ScPrepare(
            base64_encode(CERTIFICATE_SIGN),
            'docx',
            self::TIMESTAMP,
            self::LANGUAGE,
            []
        );
        /** @var ConstraintViolationListInterface $violations */
        $violations = $this->validator->validate($method->getFields(), $method->getValidationConstraints());
        // should be Certificate validation error
        $validationError = $violations->get(0);
        $this->assertSame('The value you selected is not a valid choice.', $validationError->getMessage());
    }

    public function testTimestampValidationConstraint()
    {
        $method = new ScPrepare(
            base64_encode(CERTIFICATE_SIGN),
            self::TYPE,
            '123',
            self::LANGUAGE,
            []
        );
        /** @var ConstraintViolationListInterface $violations */
        $violations = $this->validator->validate($method->getFields(), $method->getValidationConstraints());
        // should be Certificate validation error
        $validationError = $violations->get(0);
        $this->assertSame('This value should be of type bool.', $validationError->getMessage());
    }

    public function testLanguageValidationConstraint()
    {
        $method = new ScPrepare(
            base64_encode(CERTIFICATE_SIGN),
            self::TYPE,
            self::TIMESTAMP,
            'EE',
            []
        );
        /** @var ConstraintViolationListInterface $violations */
        $violations = $this->validator->validate($method->getFields(), $method->getValidationConstraints());
        // should be Certificate validation error
        $validationError = $violations->get(0);
        $this->assertSame('The value you selected is not a valid choice.', $validationError->getMessage());
    }

    public function testCreateResult()
    {
        $this->assertInstanceOf('Isign\Sign\ScPrepareResult', $this->method->createResult());
    }
}
