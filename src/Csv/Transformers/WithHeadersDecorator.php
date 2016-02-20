<?php
namespace Madewithlove\Export\Csv\Transformers;

use Madewithlove\Export\Csv\Transformer;
use Madewithlove\Export\Csv\Transformers\WithHeaders as WithHeadersTrait;
use Madewithlove\Export\Csv\WithHeaders as WithHeadersContract;

class WithHeadersDecorator implements Transformer, WithHeadersContract
{
    use WithHeadersTrait;

    /**
     * @var \Madewithlove\Export\Csv\Transformer
     */
    private $wrapped;

    /**
     * WithHeadersDecorator constructor.
     *
     * @param \Madewithlove\Export\Csv\Transformer $wrapped
     * @param array $headers
     */
    public function __construct(Transformer $wrapped, array $headers = [])
    {
        $this->wrapped = $wrapped;
        $this->setHeaders($headers);
    }

    /**
     * @param array $row
     *
     * @return array
     */
    public function transform(array $row)
    {
        return $this->wrapped->transform($row);
    }
}
