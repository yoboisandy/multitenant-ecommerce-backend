<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;

class CustomExceptionHandler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        $message = $exception->getMessage() ?? 'Internal Server Error';
        $code = empty($exception->getCode()) ? 500 : $exception->getCode();
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($exception instanceof ModelNotFoundException) {
            $modelName = strtolower(class_basename($exception->getModel()));
            $response['message'] = "Requested " . ($modelName ?? 'resource') . " not found";
        }

        if ($exception instanceof ValidationException) {
            $errors = [];
            foreach ($exception->errors() as $key => $value) {
                $errors[$key] = implode(' ', $value);
            }
            $code = 422;
            $response['message'] = $exception->getMessage() ?? 'Provided data is invalid.';
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }
}
