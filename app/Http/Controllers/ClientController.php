<?php

namespace App\Http\Controllers;

use App\Client;
use App\Address;
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

    public function truncate() {
        try {
            $clients = Client::all();
            foreach ($clients as $client) $client->delete();
        } catch(\Exception $e) {
            return response()->json(['error' => true, 'msg' => $e->getMessage()]);
        }

        return response()->json(['error' => false, 'msg' => 'Truncate ok']);
    }

    public function import(Request $request) { 
        if (!$request->hasFile('csv')) {
            return response()->json(['error' => true, 'msg' => 'missing file']);
        }

        $clientsToReturn = [];
        $header = null;
        $handle = fopen($request->csv->path(), 'r');
        $separador = $request->separador;
        
        while (($row = fgetcsv($handle, 1000, $separador)) !== false) {
            if (!$header) {
                $header = $row;
                continue;
            }

            $record = array_combine($header, $row);

            try {
                $client = Client::where('doc', '=', $record['cpf'])->first();
                if (!$client) {
                    $client = new Client;
                }

                // Insert Client
                $client->name = $record['nome'];
                $client->doc = $record['cpf'];
                $client->email = $record['email'];
                $client->bithdate = \DateTime::createFromFormat('d/m/Y', $record['datanasc']);
                if ($client->save()) $clientsToReturn[] = $client->toArray();

                // Parse address and store
                list(
                    $logradouroComNumero,
                    $bairro,
                    $cidade
                ) = explode(' - ', $record['endereco']);
                list(
                    $logradouro,
                    $numero
                ) = explode(', ', $logradouroComNumero);

                $address = new Address;
                $address->lograudoro = $logradouro;
                $address->numero = $numero;
                $address->cep = str_replace(['.', '-'], '', $record['cep']);
                $address->cidade = $cidade;
                $address->bairro = $bairro;
                $address->complemento = $record['complemento'] ?? 'N/A';
                $address->id_cliente = $client->id;
                $address->save();
            } catch (\Exception $e) {
                return response()->json([
                    'error' => true, 
                    'msg' => $e->getMessage(),
                    'data-record' => $record
                ]);
            }
        }

        return response()->json([
            'error' => false, 
            'msg' => 'ok',
            'data-record' => $clientsToReturn
        ]);
    }
}