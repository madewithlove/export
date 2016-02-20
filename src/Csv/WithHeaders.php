<?php
namespace Madewithlove\Export\Csv;

interface WithHeaders
{
    /**
     * @return array
     */
    public function getHeaders();
}
