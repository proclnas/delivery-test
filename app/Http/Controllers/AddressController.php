<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller {
    public function index() {
        $address = Address::all();
        
        return response()->json($address);
    }

    public function create(Request $request) {
        $address = new Address;
        $address->save();
        
        return response()->json($address);
    }

    public function show($id) {
        $address = Address::find($id);

        return response()->json($address);
    }

    public function destroy($id) {
        $address = Address::find($id);
        $address->delete();

        return response()->json('address removed');
    }
}