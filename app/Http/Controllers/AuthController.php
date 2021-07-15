<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AuthLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    //
    public function login(AuthLoginRequest $request)
    {
        try {
            DB::beginTransaction();

            $credentials = $request->only('email', 'password');
            
        
            if (auth()->attempt($credentials)) {

                $user = auth()->user();

                $tokenResult = $user->createToken('Spark token.');
                $token = $tokenResult->token;

                $token->save();

                $response = [
                        "token" => $tokenResult->accessToken,
                        "user" => $user,
                ];

                DB::commit();

                return $this->success('Login successful', $response);

            } else {
                return $this->unauthorized('Email or Password is incorrect!', $request->all());
            }

        } catch (\Exception $e) {
            DB::rollBack();

            return $this->error($e->getMessage(), $request->all());
        }

    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return $this->success('Successfully logged out');
    }
}
