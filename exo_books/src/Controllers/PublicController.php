<?php

namespace Src\Controllers;

use Core\Controller;

class PublicController extends Controller
{
    public function showHome()
    {
        if( $this->isLogged() )
        {
            $this->redirectToRoute('profile');
        }
        
        $this->render( 'home.phtml', './src/Views/layout.phtml');
    }
    
    public function showRegister()
    {
        $this->render( 'register.phtml', './src/Views/layout.phtml');
    }
}