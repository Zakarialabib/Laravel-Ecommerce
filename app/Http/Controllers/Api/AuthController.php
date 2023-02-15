<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function authenticate(Request $request)
{
    $url = $request->input('url');
    $token = $request->input('token');

    $client = new Client();
    $response = $client->request('GET', $url.'/sanctum/csrf-cookie');
    $response = $client->request('POST', $url.'/login', [
        'headers' => [
            'Accept' => 'application/json',
            'X-Requested-With' => 'XMLHttpRequest',
        ],
        'json' => [
            'email' => 'admin@gmail.com',
            'password' => 'your-password',
        ],
    ]);
    $response = $client->request('GET', $url.'/api/user', [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$token,
        ],
    ]);

    $user = json_decode($response->getBody(), true);
    
    // Store the API token and authenticated user in the session
    session(['api_token' => $token, 'api_user' => $user]);
    
    return response()->json(['data' => 'Authenticated successfully']);
}


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
