<?php
namespace Madewithlove\Export;

interface Exporter
{
    /**
     * @return string
     */
    public function getContent();
}
