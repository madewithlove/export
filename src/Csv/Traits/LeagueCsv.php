<?php
namespace Madewithlove\Export\Csv\Traits;

use League\Csv\Writer;
use Madewithlove\Export\Csv\Transformer;
use Madewithlove\Export\Csv\WithHeaders;
use SplTempFileObject;

trait LeagueCsv
{
    /**
     * @param \Madewithlove\Export\Csv\Transformer $transformer
     *
     * @return \League\Csv\Writer
     */
    private function writer(Transformer $transformer = null)
    {
        $writer = Writer::createFromFileObject(new SplTempFileObject());

        if ($transformer instanceof WithHeaders) {
            $writer->insertOne($transformer->getHeaders());
        }

        if ($transformer instanceof Transformer) {
            $writer->addFormatter([$transformer, 'transform']);
        }

        return $writer;
    }
}
