<?php
namespace Madewithlove\Export\Unit\Stubs;

use Madewithlove\Export\Http\Psr7Response;

class PsrController
{
    use Psr7Response {
        fileDownload as public;
    }
}
