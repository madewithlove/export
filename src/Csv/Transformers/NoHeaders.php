<?php
namespace Madewithlove\Export\Csv\Transformers;

trait NoHeaders
{
    /**
     * @return array
     */
    public function getHeaders()
    {
        return [];
    }
}
