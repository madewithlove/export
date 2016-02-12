<?php
namespace Madewithlove\Export\Http;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

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
        $response = new Response($content);
        $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $filename);
        $response->headers->set('Content-Disposition', $disposition);

        return $response;
    }
}
