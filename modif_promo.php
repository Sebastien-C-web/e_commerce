<?php

require_once('config/db.php');
require_once('ressources/avis.php');
require_once('ressources/produits.php');
require_once('ressources/produits_quantite.php');
require_once('ressources/taille.php');
require_once('ressources/promo.php');
session_start();


$db = new db();
$db->connecte();

$newProd = new Produits();
$all_prod = $newProd->getAllProduits();

$newPromo = new Promo();
$promos = $newPromo->getAllPromos();

$id = $_GET['modif'];

if (!isset($_SESSION["user"]["statut"]) == "admin") {
    header("Location: index.php");
}

if (isset($_POST["modif_article"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $image = $_FILES["image"]["name"];
    $prix = $_POST["prix"];
    $ID = $id;

    $newProd->modifProduit(["name" => $name, "description" => $description, "image" => $image, "prix" => $prix, "id" => $ID]);
    if (isset($image["name"])) {
        move_uploaded_file($image["tmp_name"], "ressources/uploads/" . $image["name"]);
    };
    header("Location: stock.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php foreach($promos as $promo) {
            if ($promo['id'] == $id) {
                print $promo['code'];
            }
        } ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header>
        <?php include_once('compo/header.php'); ?>
    </header>
    <main>
    <section class="bg-[#EDAC70] flex flex-row justify-center items-center gap-5 px-5 py-5">
        <article>
            
        </article>

    </section>

    </main>
    <footer>

    </footer>
    
</body>
</html>