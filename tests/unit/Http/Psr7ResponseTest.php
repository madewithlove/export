<?php
namespace Madewithlove\Export\Unit\Http;

use Madewithlove\Export\Unit\Stubs\PsrController;
use PHPUnit_Framework_TestCase;
use Psr\Http\Message\ResponseInterface;

class Psr7ResponseTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_psr7_response()
    {
        // Arrange
        $controller = new PsrController();

        // Act
        $response = $controller->fileDownload('foo,bar', 'export.csv');

        // Assert
        $this->assertInstanceOf(ResponseInterface::class, $response);
    }

    /** @test */
    public function response_contains_file_contents_as_body()
    {
        // Arrange
        $controller = new PsrController();

        // Act
        $response = $controller->fileDownload('foo,bar', 'export.csv');

        // Assert
        $this->assertEquals('foo,bar', $response->getBody());
    }

    /** @test */
    public function response_has_content_disposition_header()
    {
        // Arrange
        $controller = new PsrController();

        // Act
        $response = $controller->fileDownload('foo,bar', 'export.csv');
        $header = $response->getHeaderLine('Content-Disposition');

        // Assert
        $this->assertTrue($response->hasHeader('Content-Disposition'));
        $this->assertEquals('attachment; filename*=utf-8\'\'export.csv', $header);
    }
}
