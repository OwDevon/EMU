<?php

namespace Src\Models;

use Src\Managers\RoleManager;
use Src\Managers\BookManager;

class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $password;
    private ?string $avatar;
    private int $role_id;
    
    public function setId( int $id ) : void
    {
        $this->id = $id;
    }
    
    public function getId() : int
    {
        return $this->id;
    }
    
    public function setUsername( string $username ) : void
    {
        $this->username = $username;
    }
    
    public function getUsername() : string
    {
        return $this->username;
    }
    
    public function setEmail( string $email ) : void
    {
        $this->email = $email;
    }
    
    public function getEmail() : string
    {
        return $this->email;
    }
    
    public function setPassword( string $password ) : void
    {
        $this->password = $password;
    }
    
    public function getPassword() : string
    {
        return $this->password;
    }
    
    public function setAvatar( ?string $avatar ) : void
    {
        $this->avatar = $avatar;
    }
    
    public function getAvatar() : ?string
    {
        return $this->avatar;
    }
    
    public function setRoleId( int $role_id ) : void
    {
        $this->role_id = $role_id;
    }
    
    public function getRoleId() : int
    {
        return $this->role_id;
    }
    
    public function getRole()
    {
        $roleManager = new RoleManager();
        return $roleManager->find( $this->role_id );
    }
    
    public function getBooks()
    {
        $bookManager = new BookManager();
        return $bookManager->findUserBooks( $this->id );
    }
}