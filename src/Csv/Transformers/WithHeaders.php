<?php
namespace Madewithlove\Export\Csv\Transformers;

trait WithHeaders
{
    protected $headers = [];

    /**
     * @param array $headers
     *
     * @return static
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }
}
