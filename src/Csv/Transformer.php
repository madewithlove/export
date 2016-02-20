<?php
namespace Madewithlove\Export\Csv;

interface Transformer
{
    /**
     * @param array $row
     *
     * @return array
     */
    public function transform(array $row);
}