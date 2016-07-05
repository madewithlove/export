<?php
namespace Madewithlove\Export\Http;

use Psr\Http\Message\StreamInterface;
use Zend\Diactoros\Response;

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

        if (is_string($content)) {
            $body = $response->getBody();
            $body->write($content);
        } elseif ($content instanceof StreamInterface) {
            $body = $content;
        }

        return $response
            ->withBody($body)
            ->withHeader('Content-Disposition', $contentDisposition);
    }
}