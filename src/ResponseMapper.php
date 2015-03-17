<?php
namespace Isign;

/**
 * Mapping response array to result objects
 */
class ResponseMapper implements ResponseMapperInterface
{
    /**
     * @param array           $response
     * @param ResultInterface $result
     *
     * @return ResultInterface
     */
    public function map(array $response, ResultInterface $result)
    {
        foreach ($result->getFields() as $field) {
            $this->mapField($field, $response, $result);
        }

        return $result;
    }

    /**
     * Map single field from response to result object. Omit the fields which
     * are not present in response array.
     * @param string $field
     * @param array $response
     * @param ResultInterface $result
     * @return void
     */
    private function mapField($field, array $response, ResultInterface $result)
    {
        if (!isset($response[$field])) {
            return;
        }
        $method = 'set' . ucfirst($field);
        $result->$method($response[$field]);
    }
}
