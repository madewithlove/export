<?php
namespace Madewithlove\Export\Csv\Transformers;

use Madewithlove\Export\Csv\Transformer;

class CallableTransformer implements Transformer
{
    use Headers;

    /**
     * @var callable
     */
    private $wrapped;

    /**
     * CallableTransformer constructor.
     *
     * @param callable $wrapped
     */
    public function __construct(callable $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    public static function fromCallable(callable $tranformer)
    {
        return new static($tranformer);
    }

    /**
     * @param callable $wrapped
     */
    public function setTransformer(callable $wrapped)
    {
        $this->wrapped = $wrapped;
    }

    /**
     * @param array $row
     *
     * @return array
     */
    public function transform(array $row)
    {
        return call_user_func($this->wrapped, $row);
    }
}
