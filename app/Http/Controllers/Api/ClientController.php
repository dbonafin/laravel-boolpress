<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Client;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class LeadController extends Controller
{
    public function store(Request $request) {

        $data = $request->all();

        // Get validations
        $validator = Validator::make($data, [
            'name' => 'required | max:300',
            'email' => 'required | email | max:300',
            'message' => 'required | max: 60000',
        ]);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }

        $new_client = new Client();
        $new_client->fill($data);
        $new_client->save();

        return response()->json([
            'success' => true
        ]);
    }
}