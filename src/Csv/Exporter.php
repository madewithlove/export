<?php
namespace Madewithlove\Export\Csv;

use Iterator;
use Madewithlove\Export\Csv\Traits\LeagueCsv;
use Madewithlove\Export\Csv\Traits\LeagueWriter;
use Madewithlove\Export\Exporter as ExporterContract;

class Exporter implements ExporterContract
{
    use LeagueCsv;

    /**
     * @var \Madewithlove\Export\Csv\Transformer
     */
    private $transformer;

    /**
     * @var \Iterator
     */
    private $iterator;

    /**
     * Exporter constructor.
     *
     * @param \Madewithlove\Export\Csv\Transformer $transformer
     * @param \Iterator $iterator
     */
    public function __construct(Transformer $transformer = null, Iterator $iterator = null)
    {
        $this->transformer = $transformer;
        $this->iterator = $iterator;
    }

    /**
     * @param \Iterator $iterator
     *
     * @return static
     */
    public function setIterator(Iterator $iterator)
    {
        $this->iterator = $iterator;

        return $this;
    }

    /**
     * @param \Madewithlove\Export\Csv\Transformer $transformer
     */
    public function setTransformer(Transformer $transformer)
    {

    }

    /**
     * @return string
     */
    public function getContent()
    {
        return (string) $this->writer($this->transformer)->insertAll($this->iterator);
    }
}
