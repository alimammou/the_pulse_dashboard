<?php

namespace App\Http\Responses;

use Illuminate\Contracts\Support\Responsable;
use Symfony\Component\HttpFoundation\Response;

class RedirectResponse implements Responsable
{
    public function __construct(
        private string $route,
        private string | array $message,
    ) {
    }

    public static function new(string $route, string|array $message): self
    {
        return new self(
            route: $route,
            message: $message
        );
    }

    public function toResponse($request): Response|\Illuminate\Http\RedirectResponse
    {
        return redirect()
            ->to($this->route)
            ->with($this->message);
    }
}
