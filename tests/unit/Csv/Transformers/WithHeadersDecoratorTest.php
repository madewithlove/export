<?php
namespace Madewithlove\Export\Unit\Csv\Transformers;

use Madewithlove\Export\Csv\Transformer;
use Madewithlove\Export\Csv\Transformers\CallableTransformer;
use Madewithlove\Export\Csv\Transformers\WithHeadersDecorator;
use Madewithlove\Export\Csv\WithHeaders;
use PHPUnit_Framework_TestCase;

class WithHeadersDecoratorTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function implements_contracts()
    {
        // Arrange
        $mock = $this->getMock(Transformer::class);
        $transformer = new WithHeadersDecorator($mock);

        // Act

        // Assert
        $this->assertInstanceOf(Transformer::class, $transformer);
        $this->assertInstanceOf(WithHeaders::class, $transformer);
    }

    /** @test */
    public function allows_setting_headers()
    {
        // Arrange
        $mock = $this->getMock(Transformer::class);
        $transformer = new WithHeadersDecorator($mock, ['foo', 'bar']);

        // Act
        $headers = $transformer->getHeaders();

        // Assert
        $this->assertEquals(['foo', 'bar'], $headers);
    }

    /** @test */
    public function calls_wrapped_transformer_instance()
    {
        // Arrange
        $reverseTransformer = (new CallableTransformer())->setTransformer(function (array $row) {
            return array_reverse($row);
        });
        $transformer = new WithHeadersDecorator($reverseTransformer);

        // Act
        $transformed = $transformer->transform(range(0, 100));

        // Assert
        $this->assertEquals(range(100, 0, -1), $transformed);
    }
}
