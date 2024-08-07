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

if (isset($_POST["modif_promo"])) {
    $code = $_POST["code"];
    $remise = $_POST["remise"];
    $quantite = $_POST["quantite"];
    $ID = $id;

    $newPromo->modifPromo(["code" => $code, "remise" => $remise, "quantite" => $quantite, "id" => $ID]);
    header("Location: promo.php");
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
    <?php foreach ($promos as $promo) {
                    if ($promo['id'] == $id) { ?>
        <article>
        <div class="flex flex-col justify-center items-center">
                            <h2>Code promo : <?php print $promo['code']; ?></h2>
                            <p> Remise accordée : <?php print $promo['remise']; ?> % </p>
                            <p> Quantitée : <?php print $promo['quantite']; ?> </p>
                            <p> Produit(s) concerné(s) : <?php foreach($all_prod as $all_prods) {
                                if($promo["produits_id"] == $all_prods["id"]) {
                                    print $all_prods["name"];
                                }
                            } ?> </p>
        </div>                 
        </article>
        <?php }
    } ?>

    </section>
    <section>
    <form action="" method="post" class="flex flex-col justify-between border-2 border-gray-500 rounded-lg p-5 m-5">
                <div class="flex max-md:flex-col justify-around items-center">
                    <div class="flex flex-col items-center">
                        <label for="code">Code Promo :</label>
                        <input type="text" class="border-2 border-black" name="code" value=<?php foreach ($promos as $promo) {
                                                                                                    if ($promo['id'] == $id) {
                                                                                                        print $promo["code"];
                                                                                                    }
                                                                                                } ?>></input>
                    </div>
                    <div class="flex flex-col items-center">
                        <label for="remise">Remise :</label>
                        <input type="text" class="border-2 border-black" name="remise"value=<?php foreach ($promos as $promo) {
                                                                                                            if ($promo['id'] == $id) {
                                                                                                                print $promo["remise"];
                                                                                                            }
                                                                                                        } ?>></input>
                    </div>
                    <div class="flex flex-col items-center">
                        <label for="quantite">Quantitée :</label>
                        <input type="text" class="border-2 border-black" name="quantite" value=<?php foreach ($promos as $promo) {
                                                                                                if ($promo['id'] == $id) {
                                                                                                    print $promo["quantite"];
                                                                                                }
                                                                                            } ?>></input>
                    </div>
                </div>
                <div class="flex justify-around items-center pt-5">
                    <button class="border-2 border-black bg-[#f97316] w-[10%] rounded-full text-white text-center" type="submit" name="modif_promo">Modifier</button>
                </div>
            </form>
    </section>
    </main>
    <footer>

    </footer>
    
</body>
</html>