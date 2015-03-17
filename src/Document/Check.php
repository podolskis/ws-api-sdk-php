<?php
namespace Isign\Document;

use Isign\DocumentTypeProvider;
use Isign\QueryInterface;
use Isign\ResultInterface;
use Isign\Validator\Constraints\Base64;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Check
 * This method returns PDF, ADoc or MDoc file with meta data.
 * Can be used to fetch information about document’s signatures.
 *
 * @package Isign\Document
 */
class Check implements QueryInterface
{
    /** @var string Possible values: pdf, adoc, mdoc */
    private $type;

    /** @var array required keys: name, content, digest */
    private $file;

    /**
     * @param string $type
     * @param array $file
     */
    public function __construct($type, $file)
    {
        $this->type = $type;
        $this->file = $file;
    }

    /**
     * API action name, part of full API request url
     * @return string
     */
    public function getAction()
    {
        return 'check';
    }

    /**
     * Field and values association used in query
     * @return array
     */
    public function getFields()
    {
        return [
            'type'  => $this->type,
            'file'  => $this->file
        ];
    }

    /**
     * Result object for this query result
     * @return ResultInterface
     */
    public function createResult()
    {
        return new CheckResult();
    }

    /**
     * Validation constraints for fields
     * @return array
     */
    public function getValidationConstraints()
    {
        return new Assert\Collection([
            'type'  => new Assert\Required([
                new Assert\NotBlank(),
                new Assert\Choice([
                    'choices' => DocumentTypeProvider::getPrimaryDocumentTypes()
                ])
            ]),
            'file' => new Assert\Collection([
                'name' => new Assert\Required([
                    new Assert\NotBlank()
                ]),
                'content' => new Assert\Required([
                    new Assert\NotBlank(),
                ]),
                'digest' => new Assert\Required([
                    new Assert\NotBlank()
                ]),
            ])
        ]);
    }

    /**
     * HTTP method to use
     * @return string
     */
    public function getMethod()
    {
        return QueryInterface::POST;
    }
}
