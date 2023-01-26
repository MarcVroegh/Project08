<?php

class dbh {
    private $host;
    private $dbname;
    private $username;
    private $password;

    function connect() {
        $this->host = "localhost";
        $this->dbname = "hekkensluiter";
        $this->username = "root";
        $this->password = "";

        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=UTF8";
        $pdo = new PDO($dsn, $this->username, $this->password);
        return $pdo;
    }

}




