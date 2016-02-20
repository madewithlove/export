<?php
namespace Madewithlove\Export\Csv\Transformers;

use Madewithlove\Export\Csv\Transformer;

class CallableTransformer implements Transformer
{
    /**
     * @var callable
     */
    private $wrapped;

    /**
     * @param callable $transformer
     *
     * @return static
     */
    public static function fromCallable(callable $transformer)
    {
        return (new static())->setTransformer($transformer);
    }

    /**
     * @param callable $wrapped
     *
     * @return static
     */
    public function setTransformer(callable $wrapped)
    {
        $this->wrapped = $wrapped;

        return $this;
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
