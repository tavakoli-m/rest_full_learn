<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Services\ApiResponse\Facades\ApiResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;
use Symfony\Component\Routing\Exception\RouteNotFoundException;


return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $exception) {
           return ApiResponse::withMessage("not found !!")->withStatus(404)->send();
        });

        $exceptions->render(function (RouteNotFoundException $exception) {
            return ApiResponse::withMessage("Unauthenticated !!!")->withStatus(401)->send();
        });

        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
           return true;
        });
    })->create();
