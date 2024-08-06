<?php
session_start();
require_once("config/db.php");
require_once('ressources/produits.php');
require_once('ressources/produits_quantite.php');
require_once('ressources/taille.php');

$db = new db();
$db->connecte();

$newProd = new Produits();
$produits = $newProd->getAllProduits();

$newQuant = new ProduitsQuantites();
$produitsQuants = $newQuant->getAllQuantite();

$newTaille = new Taille();
$produitsTailles = $newTaille->getAllTaille();

if (!isset($_SESSION["user"]["statut"]) == "admin") {
    header("Location: index.php");
}

if (isset($_POST["envoi_taille"])) {

    $taille = $_POST["taille"];
  

    $newTaille->setTaille($taille);
    $newTaille->addTaille();
    header("Location: tailles.php");

}

if (isset($_POST["delete"])) {
    foreach ($produitsTailles as $produitTaille) {
        if ($_POST["delete"] == $produitTaille["id"]) {
            $newTaille->deleteTaille($produitTaille["id"]);
            header("Location: stock.php");
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tailles</title>
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
                <h1 class="pt-5">TAILLES :</h1>
                <a href="stock.php" class="pt-5 text-white">STOCK</h2></a>
                <a href="promo.php" class="pt-5 text-white">REDUCTIONS</h2></a>
            </div>
            <table id="tab" class="mb-5">
                <thead>
                    <tr>
                        <th class="px-5 py-2 border-2 border-black bg-white w-[5%]">Id taille</th>
                        <th class=" px-5 py-2 border-2 border-black bg-white w-[60%]">Taille</th>
                        <th class=" px-5 py-2 border-2 border-black bg-white">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produitsTailles as $produitTaille) { ?>
                        <tr>
                            <th class="px-5 py-2 border-2 border-black bg-white"><?php echo $produitTaille["id"]; ?></th>
                            <th class="px-5 py-2 border-2 border-black bg-white"><?php echo $produitTaille["taille"]; ?></th>
                            <th class="px-5 py-2 border-2 border-black bg-white">
                                <form action="" method="post">
                                    <button class="border-2 border-black bg-red-500 h-fit text-white" type="submit" name="delete" value="<?php print $produitTaille["id"]; ?>">DELETE</button>
                            </th>
                            </form>
                        <?php } ?>
                        </tr>
                </tbody>
            </table>
        </section>
        <section class="pt-5 flex flex-col">
            <h2 class="text-center font-semibold font-heading">AJOUT :</h2>
            <form action="" method="POST" class="flex flex-col justify-between">
                <div class="flex justify-around items-center pt-5">
                    <div class="flex flex-col items-center">
                        <label for="taille">Nouvelle Taille :</label>
                        <input type="text" class="border-2 border-black" name="taille"></input>
                    </div>
                </div>
                <div class="flex flex-col items-center mt-2 mb-5">
                    <button class="border-2 border-black bg-gray-300 w-[10%] text-center" type="submit" name="envoi_taille">Envoyer</button>
                </div>
            </form>
        </section>
    </main>

</body>

</html>