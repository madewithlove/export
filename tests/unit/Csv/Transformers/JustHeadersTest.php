<?php
namespace Madewithlove\Export\Unit\Csv\Transformers;

use Madewithlove\Export\Csv\Transformer;
use Madewithlove\Export\Csv\Transformers\JustHeaders;
use Madewithlove\Export\Csv\WithHeaders;
use PHPUnit_Framework_TestCase;

class JustHeadersTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function implements_contracts()
    {
        // Arrange
        $transformer = JustHeaders::fromHeaders([]);

        // Act

        // Assert
        $this->assertInstanceOf(Transformer::class, $transformer);
        $this->assertInstanceOf(WithHeaders::class, $transformer);
    }

    /** @test */
    public function doesnt_modify_row()
    {
        // Arrange
        $transformer = new JustHeaders();
        $row = range(0, 100);

        // Act
        $transformed = $transformer->transform($row);

        // Assert
        $this->assertEquals($row, $transformed);
    }

    /** @test */
    public function allows_setting_headers()
    {
        // Arrange
        $transformer = (new JustHeaders())->setHeaders(['foo', 'bar']);

        // Act
        $headers = $transformer->getHeaders();

        // Assert
        $this->assertEquals(['foo', 'bar'], $headers);
    }
}
