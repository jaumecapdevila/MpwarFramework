<?php

namespace MpwarFramework\Component\Repository\MySQL;


class MysqlRepository
{
    private $host;
    private $database;
    private $user;
    private $password;

    public function __construct()
    {
        $this->host = "localhost";
        $this->database = "";
        $this->user = "root";
        $this->password = "";
    }

    public function setDBConnectionParameters(
        $host,
        $database,
        $user,
        $password
    ) {
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;
    }

    public function exectueQuery(
        $query,
        $values = null
    ) {
        try {
            $pdo = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->user, $this->password);
            $statement = $pdo->prepare($query);
            if (!is_null($values)) {
                $statement->execute($values);
            }else {
                $statement->execute();
            }
            $queryResult = $statement->fetchAll($pdo::FETCH_ASSOC);
            return $queryResult;

        } catch (\PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
        }
    }

}
