<?php

namespace App\Exceptions;

use Exception;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

use Illuminate\Support\Facades\Log;

class Handler extends ExceptionHandler
{
    public function report(Throwable $exception)
    {
        Log::info('CustomHandler is being called');
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    { 
        if ($exception instanceof ValidationException) {
            return $this->invalidJson($request, $exception);
        }

        if ($exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException) {
            return $this->notFoundJson();
        }

        return $this->errorJson($exception);
    }

    protected function invalidJson($request, ValidationException $exception): JsonResponse
    {
        return response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $exception->errors(),
        ], 422);
    }

    protected function notFoundJson(): JsonResponse
    {
        return response()->json([
            'message' => 'Resource not found.',
        ], 404);
    }

    protected function errorJson(Throwable $exception): JsonResponse
    {
        return response()->json([
            'message' => 'An error occurred.',
            'error' => $exception->getMessage(),
        ], 500);
    }
}
