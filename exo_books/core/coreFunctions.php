<?php

function asset( $assetPath ) : string
{
    return 'public/assets/'.$assetPath;
}

function route( $route, $params = [] ) : string
{
    $queryString = '';
        
    if( count($params) > 0 )
    {
        foreach( $params as $param => $value )
        {
            $queryString .= "&".$param."=$value";
        }
    }
    
    return "index.php?route=$route".$queryString;
}

function clean( string $text ) : string
{
    return htmlspecialchars($text);
}