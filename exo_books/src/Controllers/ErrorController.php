<?php

namespace Src\Controllers;

use Core\Controller;

class ErrorController extends Controller
{
    public function notFound()
    {
        $this->render( 'notFound.phtml', './src/Views/layout.phtml' );
    }
}