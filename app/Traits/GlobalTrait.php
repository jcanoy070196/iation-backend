<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait GlobalTrait 
{   
    // Retrieve the current route name of the request
    protected function getCurrentRouteName()
    {
        return 'Route Name: ' . \Route::current()->getName();
    }

    protected function getCurrentControllerName()
    {
        return class_basename(\Route::current()->getController());
    }
    
    protected function getLogChannel()
    {
        // $controllerName = $this->getCurrentControllerName();
        // switch($controllerName)
        // {
        //     case 'AuthController':
        //         $logChannel = "auth";
        //         break;
        //     default:
        //         $logChannel = "daily";
        //         break;    
        // }
        
        // return $logChannel;
        return "single";
    }

    public function encodeArrayAsHashString($array_data)
    {
        return Crypt::encryptString(serialize($array_data));
    }

    public function decodeHashStringToArray($hash_string)
    {
        return unserialize(Crypt::decryptString($hash_string));
    }


}