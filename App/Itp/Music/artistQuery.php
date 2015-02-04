<?php

namespace Itp\Music;

class artistQuery extends \Itp\Base\Database {
    
    public function __construct()
    {
            session_start();
            parent::__construct();
    }

    public function getAll() {

        $sql = "
            SELECT artist_name, id
            FROM artists ORDER BY artist_name ASC

        ";

        $statement = static::$pdo->prepare($sql);
        $statement->execute();
        $artists = $statement->fetchAll(\PDO::FETCH_OBJ);
        return $artists;

    }

}