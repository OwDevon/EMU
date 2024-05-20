<?php

namespace Core;

abstract class Controller
{
    protected function render( $view, $template, $data = [] )
    {
        foreach( $data as $key => $value )
        {
            if( gettype($data[$key]) === 'string' )
            {
                $data[$key] = htmlspecialchars($value);
            }
        }
        
        extract($data);
        
        include_once $template;
    }
    
    protected function redirectToRoute( $route, $params = [] )
    {
        $queryString = '';
        
        if( count($params) > 0 )
        {
            foreach( $params as $param => $value )
            {
                $queryString .= "&".$param."=$value";
            }
        }
        
        header( "Location: index.php?route=$route".$queryString );
        exit();
    }
    
    public function isLogged() : bool
    {
        return isset($_SESSION['user']) && !empty($_SESSION['user']);
    }
    
    protected function isNotEmpty( $data )
    {
        return isset($data) && !empty($data);
    }
}