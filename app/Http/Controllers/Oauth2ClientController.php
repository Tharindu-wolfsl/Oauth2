<?php

namespace App\Http\Controllers;

use App\OauthClient;
use Illuminate\Support\Str;
use Laravel\Passport\Client;
use Illuminate\Http\Request;

class Oauth2ClientController extends Controller
{
    public function issueToken(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('AppName');

            return response()->json([
                'access_token' => $token->accessToken,
                'token_type' => 'Bearer',
            ]);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function registerClient(Request $request)
    {

        $request->validate([
            'name' => 'required',
        ]);
        try {
            $client = new Client();
            $client->name = $request->name;
            $client->redirect = '/'; // You can set the redirect URL
            $client->personal_access_client = false;
            $client->password_client = true;
            $client->revoked = false;
            $client->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        return response()->json([
            'client_id' => $client->id,
            'client_secret' => $client->secret,
        ]);
    }
    public function getUser(Request $request)

    {

        $user_id = $request->get("uid", 0);

        $user = User::find($user_id);

        return $user;

    }

}
