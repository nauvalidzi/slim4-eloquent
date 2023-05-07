<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Illuminate\Database\Capsule\Manager as DB;
use App\Models\Todo;

class TodoListController
{
	public function index(Request $request, Response $response, $params): Response
    {
    	$todo = Todo::all();

        $response->getBody()->write(json_encode($todo));

        return $response->withHeader('Content-Type', 'application/json');//->withHeader('Access-Control-Allow-Credentials', 'true');//->withStatus(200);
    }

    public function store(Request $request, Response $response, $params): Response
    {
        $input = $request->getParsedBody();
        // print_r($input);die;

        Todo::create([
            'title' => $input['title'],
            'body' => $input['body'],
            'status' => $input['status'] ?? 0 ,
            'updated' => date('Y-m-d H:i:s'),
        ]);

        $response->getBody()->write(json_encode(['status' => true, 'message' => 'Insert data successfully.']));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function update(Request $request, Response $response, $params): Response
    {
        $todo = Todo::find($params['id']);

        if (!$todo) {
            $response->getBody()->write(json_encode(['status' => true, 'message' => 'Data not found!']));

            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        }

        $input = $request->getParsedBody();

        $todo->update([
            'title' => $input['title'],
            'body' => $input['body'],
            'status' => $input['status'],
            'updated' => date('Y-m-d H:i:s'),
        ]);

        $response->getBody()->write(json_encode(['status' => true, 'message' => 'Data updated successfully!']));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function destroy(Request $request, Response $response, $params): Response
    {
        $todo = Todo::find($params['id']);

        if (!$todo) {
            $response->getBody->write(json_encode(['status' => true, 'message' => 'Data not found!']));

            return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
        }

        $todo->delete();

        $response->getBody()->write(json_encode("Records DELETED successfully"));

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }
}