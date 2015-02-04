<?php

namespace Itp\Music;

class genreQuery extends \Itp\Base\Database {
    
    public function __construct()
    {
            session_start();
            parent::__construct();
    }

    public function getAll() {

        $sql = "
            SELECT genre, id
            FROM genres ORDER BY genre ASC
        ";

        $statement = static::$pdo->prepare($sql);
        $statement->execute();
        $genres = $statement->fetchAll(\PDO::FETCH_OBJ);
        return $genres;

    }
}