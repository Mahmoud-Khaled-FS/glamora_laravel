<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Src\Shared\Error\AppError;
use Src\Shared\Middleware\AcceptJsonResponse;

$app = Application::configure(basePath: dirname(__DIR__));

$app->withRouting(
    web: __DIR__ . '/../routes/web.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
    api: glob(__DIR__ . '/../src/Features/**/routes/*.api.php'),
);

// TODO (MAHMOUD) - Add Global Middlewares if needed!
$app->withMiddleware(function (Middleware $middleware) {
    $middleware->api()->append([
        AcceptJsonResponse::class
    ]);
});

// TODO (MAHMOUD) - Add Global Exceptions.
$app->withExceptions(function (Exceptions $exceptions) {
    $exceptions->respond(function ($_, \Throwable $exception) {
        return AppError::fromLaravelException($exception)->render();
    });
});

return $app->create();
