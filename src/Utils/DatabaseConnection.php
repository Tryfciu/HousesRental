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

    public function addFeedbackMessage(Feedback $message)
    {
        $query = $this->connection->prepare("INSERT INTO users VALUES(NULL, :firstName, :email)");
        $query->bindValue(":firstName", $message->author, PDO::PARAM_STR);
        $query->bindValue(":email", "email", PDO::PARAM_STR);
        $query->execute();
        $userId = $this->connection->lastInsertId();
        $query = $this->connection->prepare("INSERT INTO feedback VALUES(NULL, :userId, :content, 0)");
        $query->bindValue(":userId", $userId, PDO::PARAM_INT);
        $query->bindValue(":content", $message->content, PDO::PARAM_STR);
        $query->execute();
    }
}


?>