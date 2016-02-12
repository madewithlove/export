<?php
namespace Madewithlove\Export\Csv\Traits;

use League\Csv\Writer;
use Madewithlove\Export\Csv\Transformer;
use SplTempFileObject;

trait LeagueCsv
{
    /**
     * @param \Madewithlove\Export\Csv\Transformer $transformer
     *
     * @return \League\Csv\Writer
     */
    private function writer(Transformer $transformer)
    {
        $writer = Writer::createFromFileObject(new SplTempFileObject());

        if ($headers = $transformer->getHeaders()) {
            $writer->insertOne($headers);
        }

        return $writer->addFormatter([$transformer, 'transform']);
    }
}