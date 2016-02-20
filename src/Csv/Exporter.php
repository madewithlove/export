<?php
namespace Madewithlove\Export\Csv;

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
     * @var \Traversable|array
     */
    private $items = [];

    /**
     * Exporter constructor.
     *
     * @param \Madewithlove\Export\Csv\Transformer $transformer
     * @param \Traversable|array $items
     */
    public function __construct(Transformer $transformer = null, $items = [])
    {
        $this->transformer = $transformer;
        $this->items = $items;
    }

    /**
     * @param \Traversable|array $items
     *
     * @return static
     */
    public function setItems($items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @param \Madewithlove\Export\Csv\Transformer $transformer
     *
     * @return static
     */
    public function setTransformer(Transformer $transformer)
    {
        $this->$transformer = $transformer;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return (string) $this->writer($this->transformer)->insertAll($this->items);
    }
}
