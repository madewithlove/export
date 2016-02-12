<?php
namespace Madewithlove\Export\Csv\Transformers;

use Madewithlove\Export\Csv\Transformer;

class OnlyHeaders implements Transformer
{
    /**
     * @var array
     */
    private $headers;

    /**
     * OnlyHeaders constructor.
     *
     * @param array $headers
     */
    public function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @param array $headers
     *
     * @return static
     */
    public static function fromArray(array $headers)
    {
        return new static($headers);
    }

    /**
     * @param array $row
     *
     * @return array
     */
    public function transform(array $row)
    {
        return $row;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }
}
