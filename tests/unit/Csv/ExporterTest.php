<?php
namespace Madewithlove\Export\Unit\Csv;

use ArrayIterator;
use InvalidArgumentException;
use Madewithlove\Export\Csv\Exporter;
use Madewithlove\Export\Csv\Transformers\CallableTransformer;
use Madewithlove\Export\Csv\Transformers\JustHeaders;
use Madewithlove\Export\Csv\Transformers\WithHeadersDecorator;
use Madewithlove\Export\Exporter as ExporterContract;
use Prophecy\Call\Call;

class ExporterTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function implements_contract()
    {
        // Arrange
        $exporter = new Exporter();

        // Act

        // Assert
        $this->assertInstanceOf(ExporterContract::class, $exporter);
    }

    /** @test */
    public function empty_export()
    {
        // Arrange
        $exporter = new Exporter();

        // Act
        $export = $exporter->getContent();

        // Assert
        $this->assertEmpty($export);
    }

    /** @test */
    public function basic_export()
    {
        // Arrange
        $exporter = new Exporter();
        $exporter->setItems([['foo', 'bar']]);

        // Act
        $export = $exporter->getContent();

        // Assert
        $this->assertEquals("foo,bar\n", $export);
    }

    /** @test */
    public function exports_iterators()
    {
        // Arrange
        $exporter = new Exporter();
        $exporter->setItems(new ArrayIterator([['foo', 'bar']]));

        // Act
        $export = $exporter->getContent();

        // Assert
        $this->assertEquals("foo,bar\n", $export);
    }

    /** @test */
    public function fails_when_given_invalid_items()
    {
        // Arrange
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Expected $items to be array or a \Traversable.');

        $exporter = new Exporter();

        // Act
        $exporter->setItems(new \stdClass());

        // Assert
    }

    /** @test */
    public function export_with_transformer()
    {
        // Arrange
        $reverseTransformer = (new CallableTransformer())->setTransformer(function (array $row) {
            return array_reverse($row);
        });
        $transformer = (new WithHeadersDecorator($reverseTransformer))
            ->setHeaders(['header 1', 'header 2']);

        $exporter = new Exporter();
        $exporter->setItems([['foo', 'bar']]);
        $exporter->setTransformer($transformer);

        // Act
        $export = $exporter->getContent();

        // Assert
        $this->assertEquals('"header 1","header 2"'.PHP_EOL.'bar,foo'.PHP_EOL, $export);
    }
}
