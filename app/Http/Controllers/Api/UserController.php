<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client;

class UserController extends Controller
{
    public function register(RegisterUserRequest $request) {
        User::create([
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        $client = Client::where('password_client', 1)->first();

        $request->request->add([
            'grant_type'    => 'password',
            'client_id'     => $client->id,
            'client_secret' => $client->secret,
            'username'      => $request->get('email'),
            'password'      => $request->get('password'),
            'scope'         => null,
        ]);

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        return route()->dispatch($proxy);
    }

    /**
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request) {
        $item = $request->user();
        return response()->json(compact('item'));
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['status' => true]);
    }
}
