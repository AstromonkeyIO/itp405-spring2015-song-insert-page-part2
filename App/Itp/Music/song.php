<?php

namespace Itp\Music;


class song extends \Itp\Base\Database {
    
    private $id;
    private $title;
    private $artist_id;
    private $genre_id;
    private $price;

    public function __construct()
    {
            session_start();
            parent::__construct();
    }

    public function getAll() {

        $sql = "
            SELECT genre
            FROM genres ORDER BY genre ASC
        ";

        $statement = static::$pdo->prepare($sql);
        $statement->execute();
        $genres = $statement->fetchAll(PDO::FETCH_OBJ);
        return $genres;

    }
    
    public function setTitle($title) {
        
        $this->title = $title;
        
    }
    
    public function setArtistId($id) {
        
        $this->artist_id = $id;
        
    }

    public function setGenreId($genre_id) {
        
        $this->genre_id = $genre_id;
    }

    public function setPrice($price) {
        
        $this->price = $price;
        
    }

    public function save() {
        
        $sql = "INSERT INTO songs (title, artist_id, genre_id, price) VALUES (?, ?, ?, ?)";
        $statement = static::$pdo->prepare($sql);
        $statement->bindParam(1, $this->title);
        $statement->bindParam(2, $this->artist_id);  
        $statement->bindParam(3, $this->genre_id);
        $statement->bindParam(4, $this->price);
        
        $statement->execute();
        $this->id = static::$pdo->lastInsertId();        
        
    }
    
    public function getTitle() {
        
        return $this->title;
        
    }
    
    public function getId() {
        
        return $this->id;
                
    }
    
    
        
}

