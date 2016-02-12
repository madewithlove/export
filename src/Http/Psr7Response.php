<?php
namespace Madewithlove\Export\Http;

use Zend\Diactoros\Response;
use Zend\Diactoros\Stream;

trait Psr7Response
{
    /**
     * @param string $content
     * @param string $filename
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    private function fileDownload($content, $filename)
    {
        $contentDisposition = sprintf("attachment; filename*=utf-8''%s", rawurlencode($filename));

        $response = new Response();

        $body = $response->getBody();
        $body->write($content);

        return $response
            ->withBody($body)
            ->withHeader('Content-Disposition', $contentDisposition);
    }
}