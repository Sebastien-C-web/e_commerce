<?php

require_once('config/db.php');
session_start();

$bdd = new db();
$bdd->connecte();


?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>home</title>
</head>



<body>


<audio src="imagelog/son12.mp3" autoplay></audio>


    <nav>
        <?php include('compo/header.php'); ?>
    </nav>



    <footer>
        <?php include('compo/footer.php'); ?>
    </footer>
    <script src="son.js"></script>
</body>

</html>