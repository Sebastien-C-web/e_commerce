<?php
session_start();
require_once("config/db.php");
require_once("classe/users.php");

$db= new db();
$db->connecte();


if(isset($_POST['envoyer'])){
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $name = htmlspecialchars(trim($_POST['name_ins']));
    
    $newUser = new Users();
    $newUser->setEmail($email);
    $newUser->setPassword(password_hash($password, PASSWORD_BCRYPT));
    $newUser->setName($name);
    $newUser->addUsers();
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>inscription</title>
</head>
<body>
    
<div class="flex min-h-screen bg-white">





<div class="md:w-1/2 max-w-lg mx-auto my-24 px-4 py-5 shadow-none">

    <div class="text-left p-0 font-sans">

        <h1 class=" text-gray-800 text-3xl font-medium">Créé un compte gratuitement</h1>
        <h3 class="p-1 text-gray-700">Gratuit à vie, pas de payement ensuite</h3>
    </div>
    <form action="" method="post" class="p-0">
        <div class="mt-5">

            <input type="mail" name="email"
                class="block w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent "
                placeholder="Email">
        </div>
        <div class="mt-5">
            <input type="text" name="name_ins"
                class="block w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent "
                placeholder="name">
        </div>
        <div class="mt-5">
            <input type="password" name="password"
                class="block w-full p-2 border rounded border-gray-300 focus:outline-none focus:ring-1 focus:ring-gray-400 focus:border-transparent  "
                placeholder="Mot de passe">
        </div>



        <div class="mt-10">
            <input type="submit" name="envoyer" href="index.php" value="S'inscrire avec son email"
                class="py-3 bg-green-500 text-white w-full rounded hover:bg-green-600">
        </div>
    </form>
    <a class="" href="login.php" data-test="Link"><span
            class="block  p-5 text-center text-gray-800  text-xs ">Tu as déja un compte ?</span></a>
</div>


</div>
</body>



</body>
</html>