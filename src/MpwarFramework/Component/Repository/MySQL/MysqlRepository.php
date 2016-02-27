<?php

namespace MpwarFramework\Component\Repository\MySQL;


class MysqlRepository
{
    private $host;
    private $database;
    private $user;
    private $password;

    public function __construct($host, $database, $user, $password)
    {
        $this->host = $host;
        $this->database = $database;
        $this->user = $user;
        $this->password = $password;
    }

    public function exectueQuery($query, $values = null)
    {
        try {
            $pdo = new \PDO('mysql:host=' . $this->host . ';dbname=' . $this->database, $this->user, $this->password);
            $statement = $pdo->prepare($query);
            $paramCont = 1;
            if (!is_null($values)) {

                foreach ($values as $key => $value) {
                    $statement->bindParam(':' . $key, $value);
                    $paramCont++;
                }
            }
            $statement->execute();
            $queryResult = $statement->fetchAll($pdo::FETCH_ASSOC);
            var_dump($queryResult);
            return $queryResult;

        } catch (\PDOException $e) {
            echo "Error!: " . $e->getMessage() . "<br/>";
        }
    }

}
