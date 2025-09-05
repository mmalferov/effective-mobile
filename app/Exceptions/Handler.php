<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    public function register()
    {
        Log::info($this::class);

        $this->renderable(static function (MethodNotAllowedHttpException $e, $request) {
            return response()->json([
                'status' => 405,
                'message' => 'Method Not Allowed'
            ], 405);
        });
    }
}
