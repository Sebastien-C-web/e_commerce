<?php
session_start();
require_once("config/db.php");
require_once('ressources/produits.php');
require_once('ressources/produits_quantite.php');
require_once('ressources/promo.php');

$db = new db();
$db->connecte();

$newProd = new Produits();
$produits = $newProd->getAllProduits();

$newPromo = new Promo();
$promos = $newPromo->getAllPromos();

if (!isset($_SESSION["user"]["statut"]) == "admin") {
    header("Location: index.php");
}

if (isset($_POST["envoi_promo"])) {

    $code = $_POST["code"];
    $reduction = $_POST["reduc"];
    $quantitee = $_POST["quant"];
    $produit = $_POST["assign"];

    $newPromo->setCode($code);
    $newPromo->setRemise($reduction);
    $newPromo->setQuantite($quantitee);
    $newPromo->setProduitsId($produit);
    $newPromo->addPromo();
    header("Location: promo.php");

}

if (isset($_POST["delete"])) {
    foreach ($promos as $promo) {
        if ($_POST["delete"] == $promo["id"]) {
                    $newPromo->deletePromo($promo["id"]);
                    header("Location: promo.php");
                }
            }
        }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="CSS/tableau.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.min.js" integrity="sha256-sw0iNNXmOJbQhYFuC9OF2kOlD5KQKe1y5lfBn4C9Sjg=" crossorigin="anonymous"></script>
    <link href="//cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    <script src="//cdn.datatables.net/2.1.2/js/dataTables.min.js"></script>
    <script src="JS/tableau.js"></script>
</head>

<body>
    <header>
        <?php include('compo/header.php'); ?>
    </header>
    <main>
        <section class="bg-[#EDAC70] flex flex-col justify-center items-center gap-5 px-5 ">
            <div class="flex flex-row gap-10 justify-center">
                <h1 class="pt-5">REDUCTIONS :</h1>
                <a href="stock.php" class="pt-5 text-white">STOCK</h2></a>
                <a href="tailles.php" class="pt-5 text-white">TAILLES</h2></a>
            </div>
            <table id="tab" class="mb-5">
                <thead>
                    <tr>
                        <th class="px-5 py-2 border-2 border-black bg-white w-[5%]">Id promo</th>
                        <th class=" px-5 py-2 border-2 border-black bg-white w-[10%]">Code promo</th>
                        <th class=" px-5 py-2 border-2 border-black bg-white ">Réduction</th>
                        <th class=" px-5 py-2 border-2 border-black bg-white">Quantitée</th>
                        <th class=" px-5 py-2 border-2 border-black bg-white w-[35%]">Produit concerné</th>
                        <th class=" px-5 py-2 border-2 border-black bg-white">Modif</th>
                        <th class=" px-5 py-2 border-2 border-black bg-white">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($promos as $promo) { ?>
                    <tr>

                    <th class="px-5 py-2 border-2 border-black bg-white"><?php echo $promo["id"];  ?></th>
                    <th class="px-5 py-2 border-2 border-black bg-white"><?php echo $promo["code"];  ?></th>
                    <th class="px-5 py-2 border-2 border-black bg-white"><?php echo $promo["remise"]; ?></th>
                    <th class="px-5 py-2 border-2 border-black bg-white"><?php echo $promo["quantite"]; ?></th>
                    <th class="px-5 py-2 border-2 border-black bg-white"><?php foreach($produits as $produit) {
                        if($promo["produits_id"] == $produit["id"]) {
                            echo $produit["name"];
                        }
                    } ?></th>
                    <th class="px-5 py-2 border-2 border-black bg-white">
                            <form method="GET" action="modif_promo.php"><button class="bg-black text-white border-2 border-black p-2" id="modif" type="submit" name="modif" value="<?php print $promo["id"]; ?>">Modif</button></form>
                        </th>
                    <th class="px-5 py-2 border-2 border-black bg-white"> <form action="" method="post">
                    <button class="border-2 border-black bg-[#f97316] rounded-full w-[90%] h-fit text-white" type="submit" name="delete"
                            value="<?php print $promo["id"]; ?>">DELETE</button></form></th>
                        
                    <?php } ?>
                    </tr>
                </tbody>
                </table>

        </section>
        </section>
        <section class="pt-5">
            <h2 class="text-center font-semibold font-heading">AJOUT :</h2>
            <form action="" method="POST" class="flex flex-col justify-between border-2 border-gray-500 rounded-lg m-5">
                <div class="flex justify-around items-center">
                    <div class="flex flex-col items-center">
                        <label for="code">Code promo :</label>
                        <input  type="text" class="border-2 border-black" name="code">
                    </div>
                    <div class="flex flex-col items-center">
                        <label for="reduc">Réduction (en %) :</label>
                        <input type="number" max="100" min="1" class="border-2 border-black w-[80%]" name="reduc"></input>
                    </div>
                    <div class="flex flex-col items-center">
                        <label for="quant">Quantitée :</label>
                        <input type="text" class="border-2 border-black" name="quant"></input>
                    </div>
                    <div class="flex flex-col items-center">
                        <label for="assign">Assignation :</label>
                        <select name="assign">
                        <option value="">Veuillez choisir le produit concerné :</option>
                        <?php foreach($produits as $produit){ ?>
                        <option value="<?php
                            echo $produit["id"];?>"
                         > <?php echo $produit["id"];?>-  <?php echo $produit["name"]; } ?> </option>
                        </select>
                    </div>
                </div>
                </div>
                <div class="flex flex-col items-center mt-5 mb-5">
                    <button class="border-2 border-black bg-[#f97316] w-[10%] rounded-full text-white text-center" type="submit" name="envoi_promo">Envoyer</button>
                    </div>
            </form>
        </section>
    </main>
    <footer>

    </footer>
</body>

</html>