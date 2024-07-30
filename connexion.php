<?php
session_start();
require_once("classe/users.php");

$db = new db();
$db->connecte();

if (isset($_POST['submit'])) {

    $name = trim($_POST['name_con']);
    $password = trim($_POST['password_con']);
    // $email = trim($_POST['email']);

    if (!empty($name) && !empty($password) || (!empty($email) && !empty($password))) {
        $user = new Users();
        $utilisateur = $user->userConnect(["name" => $name, "password" => $password]);
        // $user = $user->userConnect(["email"=> $email, "password"=>$password]);

        if ($user) {
            $_SESSION['user'] = $utilisateur;
            $message = null;
            header("Location:index.php");
        } else {
            $message = "Nom ou mot de passe incorrect";
        }
    } else {
        $message = "veuillez remplir tous les champs";
    }
    
}





?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>connexion</title>
</head>

<body>
   


    <div class="  text-red-700 text-2xl text-center ">
        <?php if (isset($message)) {
            echo $message;
        } ?>
    </div>

    <form class="w-full flex flex-col jusstify-center items-center gap-3" action="" method="post">
        <label for="name">Nom</label>
        <input class="border-2 border-black w-[50%]" type="text" name="name_con" id="name">
        <label for="password">Password</label>
        <input class="border-2 border-black w-[50%]" type="password" name="password_con" id="password">

        <div class="flex justify-center  ">
            <button class="border-2 border-black hover:text-orange-600 " type="submit" name="submit">Connexion</button>
        </div>
    </form>
    <div class="  text-red-700 text-2xl text-center ">
        <?php if (isset($message)) {
            echo $message;
        } ?>
    </div>

    <footer>
       
    </footer>

</body>

</html>