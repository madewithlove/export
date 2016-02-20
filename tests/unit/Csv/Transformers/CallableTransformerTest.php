<?php
namespace Madewithlove\Export\Unit\Csv\Transformers;

use Madewithlove\Export\Csv\Transformer;
use Madewithlove\Export\Csv\Transformers\CallableTransformer;
use PHPUnit_Framework_TestCase;

class CallableTransformerTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function implements_contract()
    {
        // Arrange
        $transformer = CallableTransformer::fromCallable(function (array $row) {
            return $row;
        });

        // Act

        // Assert
        $this->assertInstanceOf(Transformer::class, $transformer);
    }

    /** @test */
    public function created_from_callable_and_executes_it()
    {
        // Arrange
        $transformer = CallableTransformer::fromCallable(function (array $row) {
            return array_reverse($row);
        });

        // Act
        $transformed = $transformer->transform(['foo', 'bar', 'baz']);

        // Assert
        $this->assertEquals(['baz', 'bar', 'foo'], $transformed);
    }

    /** @test */
    public function sets_callable_and_executes_it()
    {
        // Arrange
        $transformer = (new CallableTransformer())->setTransformer(function (array $row) {
            return array_reverse($row);
        });

        // Act
        $transformed = $transformer->transform(['foo', 'bar', 'baz']);

        // Assert
        $this->assertEquals(['baz', 'bar', 'foo'], $transformed);
    }
}
