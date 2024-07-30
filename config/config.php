<?php

include 'class/users.php';


class db
{
    private $db;


    public function connecte()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=ecommerce", 'root', '');
            return $this->db;
        } catch (PDOException $e) {
            $error = fopen('error.log', 'w');
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("Error 404");
        }
    }


    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $done = $this->db->query($sql);
        return $done->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addUsers(Users $users)
    {
        $email = $users->getEmail();
        $name = $users->getName();
        $password = $users->getPassword();
        $sql = $this->db->prepare("INSERT INTO users (statut,email,pseudo,password) VALUES ('utilisateur',:email,:pseudo,:password ) ");
        $sql->bindParam(":email", $email);
        $sql->bindParam(":name", $name);
        $sql->bindParam(":password", $password);
        $sql->execute();
    }
    public function userConnect($tab = [])
    {
        $user = $this->getAllUsers();
        foreach ($user as $users) {
            if (($tab['name'] == $users['name'] || $tab['email'] == $users['email']) && password_verify($tab['password'], $users['password'])) {
                return $users;
            }
        }
    }







}

