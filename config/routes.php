<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\TodoListController;
use Slim\App;
// use Slim\Exception\HttpNotFoundException;

return function (App $app) {
    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
                ->withHeader('Access-Control-Allow-Origin', 'http://localhost:4200')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });

    $app->get('/', function ($request, $response, array $args) {
        $response->getBody()->write(json_encode(['status' => true]));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    });

    $app->get('/todo', [TodoListController::class, 'index']);
    $app->post('/todo', [TodoListController::class, 'store']);
    $app->patch('/todo/{id}', [TodoListController::class, 'update']);
    $app->delete('/todo/{id}', [TodoListController::class, 'destroy']);

    // /**
    //  * Catch-all route to serve a 404 Not Found page if none of the routes match
    //  * NOTE: make sure this route is defined last
    //  */
    // $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
    //     throw new HttpNotFoundException($request);
    // });
};