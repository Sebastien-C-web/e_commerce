<?php
session_start();
require_once 'config/config.php';
$db= new db();
$db->connecte();
if(isset($_POST['envoyer'])){
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $name = htmlspecialchars(trim($_POST['name']));
    $new_users = new Users();
    $new_users->setEmail($email);
    $new_users->setPassword(password_hash($password, PASSWORD_BCRYPT));
    $new_users->setName($name);
    $db->addUsers($new_users);
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    
</body>
</html>