<?php


namespace Isign\Tests\Document;

use Isign\Document\Check;
use Isign\QueryInterface;
use Isign\Tests\TestCase;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CheckTest extends TestCase
{
    const TYPE = 'pdf';
    const NAME = 'document.pdf';

    /** @var  Check */
    private $query;

    /** @var  ValidatorInterface */
    private $validator;

    public function setUp()
    {
        $this->query = new Check(
            self::TYPE,
            [
                'name' => self::NAME,
                'digest' => sha1(file_get_contents(__DIR__.'/../data/document.pdf')),
                'content' => base64_encode(file_get_contents(__DIR__.'/../data/document.pdf'))
            ]
        );

        $this->validator = Validation::createValidator();
    }

    public function testGetFields()
    {
        $fields = $this->query->getFields();

        $this->assertArrayHasKey('type', $fields);
        $this->assertArrayHasKey('file', $fields);
        $this->assertArrayHasKey('name', $fields['file']);
        $this->assertArrayHasKey('digest', $fields['file']);
        $this->assertArrayHasKey('content', $fields['file']);

        $this->assertSame(self::TYPE, $fields['type']);
        $this->assertSame(self::NAME, $fields['file']['name']);
    }

    public function testGetAction()
    {
        $this->assertSame('check', $this->query->getAction());
    }

    public function testGetMethod()
    {
        $this->assertSame(QueryInterface::POST, $this->query->getMethod());
    }

    public function testValidationConstraints()
    {
        $violations = $this->validator->validate(
            $this->query->getFields(),
            $this->query->getValidationConstraints()
        );

        $this->assertEquals(0, count($violations));
    }

    public function testEmptyFileValidationConstraints()
    {
        $check = new Check(
            self::TYPE,
            [
                'name' => '',
                'digest' => '',
                'content' => ''
            ]
        );

        $violations = $this->validator->validate(
            $check->getFields(),
            $check->getValidationConstraints()
        );

        $this->assertEquals(3, count($violations));
    }

    public function testCreateResult()
    {
        $this->assertInstanceOf('Isign\Document\CheckResult', $this->query->createResult());
    }
}
