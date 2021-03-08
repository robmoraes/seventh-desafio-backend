<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \GuzzleHttp\Client;
use \GuzzleHttp\Exception\ClientException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->username;
        $password = $request->password;

        try {
            $client = new Client;
            $payload = [
                "grant_type" => "password",
                "client_id" => config('passport.personal_access_client.id'),
                "client_secret" => config('passport.personal_access_client.secret'),
                "username" => $username,
                "password" => $password,
                "scope" => "",
            ];

            $response = $client->request('POST', config('app.url').'/oauth/token', [
                'json' => $payload,
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ],
            ]);

            $token = json_decode((string) $response->getBody());
            $user = $this->getUser($token->access_token);

            return response()->json([
                'token' => $token,
                'user' => $user
            ]);

            // return response($response->getBody(), 200)
            //     ->header('Content-Type', 'application/json');
        } catch (ClientException $e) {
            return response($e->getMessage(), 400);
        }
    }

    private function getUser($token)
    {
        try {
            $client = new Client;

            $response = $client->request('GET', config('app.url').'/api/user', [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '.$token,
                ],
            ]);

            return json_decode((string) $response->getBody());
        } catch (ClientException $e) {
            return [];
        }
    }
}
