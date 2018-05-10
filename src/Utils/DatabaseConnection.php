<?php

namespace App\Utils;

use PDO;

class DatabaseConnection
{
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $database = "housesrental";
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->database};charset=utf8", $this->user, $this->password,
                                        [PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (PDOException $error) {
            exit("Database error.");
        }
    }

    public function getFeedbackMessages()
    {
        $query = $this->connection->prepare("SELECT First_name, Content FROM feedback, users WHERE feedback.User_id = users.Id");
        $query->execute();
        $messages = [];

        foreach($query->fetchAll() as $value)
        {
            $messages[] = new Feedback($value["First_name"], $value["Content"]);
        }

        return $messages;
    }
}


?>