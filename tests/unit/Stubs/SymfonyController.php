<?php
namespace Madewithlove\Export\Unit\Stubs;

use Madewithlove\Export\Http\SymfonyResponse;

class SymfonyController
{
    use SymfonyResponse {
        fileDownload as public;
    }
}
