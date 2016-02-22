<?php
namespace Madewithlove\Export\Csv\Transformers;

use Madewithlove\Export\Csv\Transformer;
use Madewithlove\Export\Csv\Transformers\WithHeaders as WithHeadersTrait;
use Madewithlove\Export\Csv\WithHeaders as WithHeadersContract;

class JustHeaders implements Transformer, WithHeadersContract
{
    use WithHeadersTrait;

    /**
     * @param array $headers
     *
     * @return static
     */
    public static function fromHeaders(array $headers)
    {
        return (new static())->setHeaders($headers);
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
}
