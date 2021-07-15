<?php

namespace App\Traits;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

trait ResponseTrait 
{   
    // The request has been successful and this will reply a message
    protected function success($message, $data = [], $withLogging = true, $status = 200)
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->info($this->getCurrentRouteName() . ' | ' . $message, $data);
        }

        return response([
            'success' => true,
            'data'   => $data, 
            'message' => $message,
        ], $status);
    }

    // The request has been successful and this will send back the resulting data with a message
    protected function created($message, $data = [], $withLogging = true, $status = 201)
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->info($this->getCurrentRouteName() . ' | ' . $message, $data);
        }

        return response([
            'success' => true,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    // The request has been successful but not acted upon and this will reply a message
    protected function accepted($message, $data = [], $withLogging = true, $status = 202)
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->info($this->getCurrentRouteName() . ' | ' . $message, $data);
        }

        return response([
            'success' => true,
            'data'   => $data, 
            'message' => $message,
        ], $status);
    }

    // The request has been unsuccessful and this will only send the error message
    protected function error($message, $data = [], $withLogging = true,  $status = 422)
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->error($this->getCurrentRouteName() . ' | ' . $message, $data);
        }

        return response([
            'success' => false,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    // The request has an invalid syntax and this will send back the data that was thrown with the error message
    protected function badRequest($message, $data = [], $withLogging = true, $status = 400)
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->warning($this->getCurrentRouteName() . ' | ' . $message, $data);
        }

        return response([
            'success' => false,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    // The request has been denied due to invalid login token and this will send back a message
    protected function unauthorized($message, $data = [], $withLogging = true, $status = 401)
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->critical($this->getCurrentRouteName() . ' | ' . $message, $data);
        }
        
        return response([
            'success' => false,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    // The request has been accepted but does not have the authority to access the target endpoint and this will send back a message
    protected function forbidden($message, $data = [], $withLogging = true, $status = 403)
    {
        if($withLogging) {
            $logChanel = $this->getLogChannel();
            Log::channel($logChanel)->alert($this->getCurrentRouteName() . ' | ' . $message, $data);
        }

        return response([
            'success' => false,
            'data' => $data,
            'message' => $message,
        ], $status);
    }

    // Send back the data as a JSON response
    protected function json($data)
    {
        return response()->json($data);
    } 
    
    // Send back the data as a JSON response
    protected function sendToken($token, $data)
    {
        $message = 'Successfully created an access token.';

        $data['access_token'] = $token->accessToken;
        $data['token_type'] = 'Bearer';
        $data['expires_at'] = Carbon::parse(
                $token->token->expires_at
            )->toDateTimeString();

        $logChanel = $this->getLogChannel();

        return $this->created($message, $data);
    }    
    
}