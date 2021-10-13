<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RedirectInternallyMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        if (! $response->exception instanceof ValidationException) {
            return $response;
        }

        do {
            $kernel = $this->kernel();

            $response = $kernel->handle(
                $request = $this->createRequestFrom($request)
            );

            $kernel->terminate($request, $response);
        } while ($response->isRedirect());

        return $response->setStatusCode(422);
    }

    private function kernel(): Kernel
    {
        return app()->make(Kernel::class);
    }

    private function createRequestFrom($baseRequest)
    {
        $request = Request::create(route('posts.create'), 'GET');

        $request->headers->replace($baseRequest->headers->all());

        return $request;
    }
}
