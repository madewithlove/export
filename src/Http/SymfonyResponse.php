<?php
namespace Madewithlove\Export\Http;

use Psr\Http\Message\StreamInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

trait SymfonyResponse
{
    /**
     * @param string $content
     * @param string $filename
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    private function fileDownload($content, $filename)
    {
        if ($content instanceof StreamInterface) {
            $response = new StreamedResponse();

            $response->setCallback(function () use ($content) {
                $content->rewind();

                while (! $content->eof()) {
                    echo $content->read(8192);
                }
            });
        } else {
            $response = new Response($content);
        }

        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $filename);
        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}
