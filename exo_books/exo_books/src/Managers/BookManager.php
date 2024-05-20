<?php

namespace Src\Managers;

use Core\Manager;
use Src\Models\Book;

class BookManager extends Manager
{
    public function __construct()
    {
        $this->model = Book::class;
    }
    
    public function findUserBooks( int $userid )
    {
        return $this->fetchAll( "SELECT * FROM book WHERE user_id = :userid", [
           ':userid' =>  $userid
        ]);
    }
}