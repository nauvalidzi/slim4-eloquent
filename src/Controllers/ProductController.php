<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;
use App\Models\Product;

class ProductController
{
	public function index(Request $request, Response $response, $params): Response
    {
    	$products = Product::paginate(15);

    	// without model
    	// $products_init = DB::table('products')->get();

        $response->getBody()->write(json_encode($products));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}