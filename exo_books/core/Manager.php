<?php

namespace Core;

abstract class Manager
{
    private static $db;
    protected $query;
    protected $model;
    
    private static function setDb()
    {
        self::$db = new \PDO(
            'mysql:host='.DB_HOST.';port='.DB_PORT.';dbname='.DB_NAME.';charset='.DB_CHARSET,
            DB_USER,
            DB_PASSWORD
        );
    }
    
    protected function getDb()
    {
        if( self::$db == null )
        {
            self::setDb();
        }
        return self::$db;
    }
    
    public function findAll()
    {
        return $this->fetchAll("SELECT * FROM " . $this->getTableName());
    }
    
    public function find( int $id )
    {
        return $this->fetch("SELECT * FROM " . $this->getTableName() . " WHERE id = :id", [
            ':id' => $id    
        ]);
    }
    
    
    // $categoryManager->create([ 'name' => "Fantastique" ])
    public function create( array $data )
    {
        $columns = "";
        $values = "";
        $executeParams = [];
        
        foreach( $data as $column => $value )
        {
            $columns .= " $column,"; // name,
            $values .= " :$column,"; // :name,
            $executeParams[":$column"] = $value; // [ ':name' => "Fantastique" ]
        }
        $columns = substr( $columns, 0, -1); // name
        $values = substr( $values, 0, -1); // :name
        // INSERT INTO category ( name ) VALUES ( :name )
        $this->query = $this->getDb()->prepare("INSERT INTO " . $this->getTableName() ." (". $columns .") VALUES (". $values .")");
        $this->query->execute($executeParams);
        // [ ':name' => "Fantastique" ]
    }
    
    public function update( array $data )
    {
        $sets = "";
        $executeParams = [];
        foreach( $data as $column => $value )
        {
            if( $column !== 'id' )
            {
               $sets .= " $column = :$column,"; 
            }
            $executeParams[":$column"] = $value; 
        }
        $sets = substr( $sets, 0, -1 );
        $this->query = $this->getDb()->prepare("UPDATE ".$this->getTableName()." SET ".$sets." WHERE id = :id");
        $this->query->execute($executeParams);
    }
    
    public function remove( int $id )
    {
        $this->query = $this->getDb()->prepare("DELETE FROM " . $this->getTableName() . " WHERE id = :id");
        $this->query->execute([
            ':id' => $id    
        ]);
    }
    
    private function getTableName()
    {
        $xplodedModel = explode('\\', $this->model);
        $modelName = end($xplodedModel);
        return lcfirst($modelName);
    }
    
    protected function fetch( $sql, $params = [] )
    {
        $this->query = $this->getDb()->prepare($sql);
        $this->query->setFetchMode( \PDO::FETCH_CLASS, $this->model );
        $this->query->execute($params);
        return $this->query->fetch();
    }
    
    protected function fetchAll( $sql, $params = [] )
    {
        $this->query = $this->getDb()->prepare($sql);
        $this->query->setFetchMode( \PDO::FETCH_CLASS, $this->model );
        $this->query->execute($params);
        return $this->query->fetchAll();
    }
    
    
}