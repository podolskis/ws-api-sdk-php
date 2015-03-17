<?php
namespace Isign\Document;


use Isign\DocumentTypeProvider;
use Isign\QueryInterface;
use Isign\ResultInterface;
use Isign\Validator\Constraints\Base64;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Archive
 * Prepares the document’s signatures for long-term document storage.
 * If document’s signatures are not prepared for long term storage and certificate is revoked or expired,
 * signed document is immediately rendered invalid.
 * Thus, archiving function is very important for all real-life scenarios
 * where signature’s meaning must be persisted through longer periods.
 *
 * @package Isign\Document
 */
class Archive implements QueryInterface
{
    /** @var string Possible values: pdf, adoc, mdoc */
    private $type;

    /** @var array file */
    private $file;

    /** @var array of signatures with required id key */
    private $signatures;

    /**
     * @param string $type Possible values: pdf, adoc, mdoc
     * @param array $file
     * @param array $signatures
     */
    public function __construct($type, $file, $signatures)
    {
        $this->type = $type;
        $this->file = $file;
        $this->signatures = $signatures;
    }

    /**
     * API action name, part of full API request url
     * @return string
     */
    public function getAction()
    {
        return 'archive';
    }

    /**
     * Field and values association used in query
     * @return array
     */
    public function getFields()
    {
        return [
            'type' => $this->type,
            'file' => $this->file,
            'signatures' => $this->signatures
        ];
    }

    /**
     * Result object for this query result
     * @return ResultInterface
     */
    public function createResult()
    {
        return new ArchiveResult();
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
                    //new Base64()
                ]),
                'digest' => new Assert\Required([
                    new Assert\NotBlank()
                ]),
            ]),
            'signatures' => new Assert\Collection([])
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
