<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        // GeneralException::class,
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function report(Throwable $e)
    {
        parent::report($e);
    }

    public function render($request, Throwable $e): Response
    {
//        dd($e);

        if (config('app.debug')) {
            return $this->handleDebugException($request, $e);
        }

        return $this->handleProdException($request, $e);
    }

    /**
     * @throws Throwable
     */
    private function handleDebugException(Request $request, Throwable $e): Response
    {
        return parent::render($request, $e);
    }

    /**
     * @throws Throwable
     */
    private function handleProdException($request, $e): Response
    {
        if ($request->expectsJson()) {
            if ($e instanceof ModelNotFoundException) {
                return $this->notFoundError();
            }
        }

        return parent::render($request, $e);
    }

    private function notFoundError(): JsonResponse
    {
        return response()->json([
            'message' => 'No resource was found',
        ], 404);
    }

    protected function unauthenticated($request, AuthenticationException $exception): Response
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
