<?php

namespace Src\Managers;

use Core\Manager;
use Src\Models\User;

class UserManager extends Manager
{
    public function __construct()
    {
        $this->model = User::class;
    }
    
    public function findByEmail( string $email )
    {
        return $this->fetch( "SELECT * FROM user WHERE email = :email", [ ':email' => $email ]);
    }
}