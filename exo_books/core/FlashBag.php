<?php

namespace Core;

class FlashBag
{
    public static function set( string $message, string $type )
    {
        $_SESSION['flashbag'] = [
            'message' => $message,
            'type' => $type
        ];
    }
    
    public static function get() : array
    {
        if( !empty( $_SESSION['flashbag'] ) && is_array( $_SESSION['flashbag'] ) )
        {
            $flashbag = $_SESSION['flashbag'];
            unset($_SESSION['flashbag']);
            return $flashbag;
        }
        return [];
    }
}