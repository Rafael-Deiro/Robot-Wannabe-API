<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateTokenRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function createToken(CreateTokenRequest $request)
    {
        $token = $request->user()->createToken($request->token_name);
        return response()->json([ 'token' => $token->plainTextToken ]);
    }
}
