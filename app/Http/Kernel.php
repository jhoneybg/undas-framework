<?php

namespace App\Http;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;

class Kernel implements HttpExceptionInterface
{
    public function __construct()
    {
        //
    }

    public function handle(Request $request, $type = self::MASTER_REQUEST, $catch = true)
    {
        //
    }
}
