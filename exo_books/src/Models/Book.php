<?php

namespace Src\Models;

use Src\Managers\CategoryManager;
use Src\Managers\UserManager;

class Book
{
    private int $id;
    private string $title;
    private string $author;
    private string $cover;
    private $published_at;
    private int $category_id;
    private int $user_id;
    
    public function setId( int $id ) : void
    {
        $this->id = $id;
    }
    
    public function getId() : int
    {
        return $this->id;
    }
    
    public function setTitle( string $title ) : void
    {
        $this->title = $title;
    }
    
    public function getTitle() : string
    {
        return $this->title;
    }
    
    public function setAuthor( string $author ) : void
    {
        $this->author = $author;
    }
    
    public function getAuthor() : string
    {
        return $this->author;
    }
    
    public function setCover( string $cover ) : void
    {
        $this->cover = $cover;
    }
    
    public function getCover() : string
    {
        return $this->cover;
    }
    
    public function setPublishedAt( $published_at ) : void
    {
        $this->published_at = $published_at;
    }
    
    public function getPublishedAt()
    {
        return $this->published_at;
    }
    
    public function setCategoryId( int $category_id ) : void
    {
        $this->category_id = $category_id;
    }
    
    public function getCategoryId() : int
    {
        return $this->category_id;
    }
    
    public function setUserId( int $user_id ) : void
    {
        $this->user_id = $user_id;
    }
    
    public function getUserId() : int
    {
        return $this->user_id;
    }
    
    public function getCategory()
    {
        $categoryManager = new CategoryManager();
        return $categoryManager->find( $this->category_id );
    }
    
    public function getUser()
    {
        $userManager = new UserManager();
        return $userManager->find( $this->user_id );
    }
}