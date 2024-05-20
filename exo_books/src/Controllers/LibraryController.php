<?php

namespace Src\Controllers;

use Core\Controller;
use Src\Managers\BookManager;

class LibraryController extends Controller
{
    public function showLibrary()
    {
        $userId = $_SESSION['user_id'];
        $books = $this->bookManager->getBooksByUser($userId);
        $this->render( 'library.phtml', './src/Views/layout.phtml' );
    }
}