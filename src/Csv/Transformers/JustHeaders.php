<?php
namespace Madewithlove\Export\Csv\Transformers;

use Madewithlove\Export\Csv\Transformer;
use Madewithlove\Export\Csv\WithHeaders;
use Madewithlove\Export\Csv\Transformers\WithHeaders as WithHeadersTrait;

class JustHeaders implements Transformer, WithHeaders
{
    use WithHeadersTrait;

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
