<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Controllers\ProductController;
use Slim\App;

return function (App $app) {
    $app->get('/', [ProductController::class, 'index']);
};