<?php


namespace Isign\Tests\Document;

use Isign\Document\Archive;
use Isign\Document\Check;
use Isign\QueryInterface;
use Isign\Tests\TestCase;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ArchiveTest extends TestCase
{
    const TYPE = 'pdf';
    const NAME = 'document.pdf';

    /** @var  Check */
    private $query;

    /** @var  ValidatorInterface */
    private $validator;

    public function setUp()
    {
        $this->query = new Archive(
            self::TYPE,
            [
            'name' => self::NAME,
            'digest' => sha1(file_get_contents(__DIR__.'/../data/document.pdf')),
            'content' => base64_encode(file_get_contents(__DIR__.'/../data/document.pdf'))
            ],
            [
                ['id' => 'signature_0'],
                ['id' => 'signature_1']
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
        $this->assertArrayHasKey('id', $fields['signatures'][0]);

        $this->assertSame(self::TYPE, $fields['type']);
        $this->assertSame(self::NAME, $fields['file']['name']);
        $this->assertSame('signature_0', $fields['signatures'][0]['id']);
    }

    public function testGetAction()
    {
        $this->assertSame('archive', $this->query->getAction());
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
        $check = new Archive(
            self::TYPE,
            [
                'name' => '',
                'digest' => '',
                'content' => ''
            ],
            [
                ['id' => 'signature_0'],
                ['id' => 'signature_1']
            ]
        );

        /** @var ConstraintViolationListInterface $violations */
        $violations = $this->validator->validate(
            $check->getFields(),
            $check->getValidationConstraints()
        );

        $this->assertEquals(3, count($violations));
    }

    public function testCreateResult()
    {
        $this->assertInstanceOf('Isign\Document\ArchiveResult', $this->query->createResult());
    }
}
