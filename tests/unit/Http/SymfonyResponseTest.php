<?php
namespace Madewithlove\Export\Unit\Http;

use Madewithlove\Export\Unit\Stubs\SymfonyController;
use PHPUnit_Framework_TestCase;
use Symfony\Component\HttpFoundation\Response;

class SymfonyResponseTest extends PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_returns_psr7_response()
    {
        // Arrange
        $controller = new SymfonyController();

        // Act
        $response = $controller->fileDownload('foo,bar', 'export.csv');

        // Assert
        $this->assertInstanceOf(Response::class, $response);
    }

    /** @test */
    public function response_contains_file_contents_as_body()
    {
        // Arrange
        $controller = new SymfonyController();

        // Act
        $response = $controller->fileDownload('foo,bar', 'export.csv');

        // Assert
        $this->assertEquals('foo,bar', $response->getContent());
    }

    /** @test */
    public function response_has_content_disposition_header()
    {
        // Arrange
        $controller = new SymfonyController();

        // Act
        $response = $controller->fileDownload('foo,bar', 'export.csv');
        $header = $response->headers->get('Content-Disposition');

        // Assert
        $this->assertTrue($response->headers->has('Content-Disposition'));
        $this->assertEquals('attachment; filename="export.csv"', $header);
    }
}
