<?php

namespace Core;

class Router
{
    private array $routes;
    
    public function addRoute( string $name, string $handler )
    {
       $this->routes[$name] = $handler;
    }
    
    public function route()
    {
        if( array_key_exists( 'route', $_GET) )
        {
            if( array_key_exists( $_GET['route'], $this->routes ) )
            {
                $handler = explode( '::', $this->routes[$_GET['route']]);
                
                $controllerName = $handler[0];
                $methodName     = $handler[1];
                
                $controller = new $controllerName();
                $controller->$methodName();
            }
            else
            {
                header('Location: index.php?route=notFound');
                exit();
            }
        }
        else
        {
            header('Location: index.php?route=home');
            exit();
        }
    }
}