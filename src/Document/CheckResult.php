<?php


namespace Isign\Document;

use Isign\ResultInterface;

class CheckResult implements ResultInterface
{
    /** @var string response status */
    private $status;

    /** @var  array document structure */
    private $structure;
    /**
     * Fields expected in response
     * @return array
     */
    public function getFields()
    {
        return [
            'status',
            'structure'
        ];
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getStructure()
    {
        return $this->structure;
    }

    /**
     * @param array $structure
     */
    public function setStructure($structure)
    {
        $this->structure = $structure;
    }
}
