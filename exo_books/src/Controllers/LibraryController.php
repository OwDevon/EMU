<?php

namespace Src\Controllers;

use Core\Controller;

class LibraryController extends Controller
{
    public function showLibrary()
    {
        $this->render( 'library.phtml', './src/Views/layout.phtml' );
    }
}