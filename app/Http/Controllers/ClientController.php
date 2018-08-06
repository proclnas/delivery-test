<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller {
    public function index() {
        $clients = Client::all();
        return response()->json($clients);
    }

    public function create(Request $request) {
        $client = new Client;
        $client->save();
        
        return response()->json($client);
    }

    public function show($id) {
        $client = Client::find($id);

        return response()->json($client);
    }

    public function destroy($id) {
        $client = Client::find($id);
        $client->delete();

        return response()->json('Cliente removed');
    }
}