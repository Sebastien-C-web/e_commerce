<?php
session_start();
require_once("config/db.php");
require_once('ressources/produits.php');
require_once('ressources/produits_quantite.php');
require_once('ressources/taille.php');
require_once("classe/users.php");
require_once('classe/panierclass.php');

$newPanier = new panier();
$newArticles = new Produits();
$total = 0;
$db = new db();
$db->connecte();

$newProd = new Produits();
$produits = $newProd->getAllProduits();

$newQuant = new ProduitsQuantites();
$produitsQuants = $newQuant->getAllQuantite();


if (!isset($_SESSION["user"]["statut"]) == "admin") {
    header("Location: index.php");
}


if (isset($_POST['envoi_article'])) {

    $imgInfos = $_FILES["image"]["name"];

    $name = $_POST["name"];
    $description = $_POST["description"];
    $image = $imgInfos . "_" . time();
    $prix = $_POST["prix"];

    $newProd->setName($name);
    $newProd->setDescription($description);
    $newProd->setImage($image);
    $newProd->setPrix($prix);
    $newProd->addProduit();
    if (isset($image)) {
        move_uploaded_file($_FILES["image"]["tmp_name"], "ressources/uploads/" . $image);
    };

    header("Location: stock.php");
}

if (isset($_POST["qtte"])) {
    $produitID = $_POST["qtte"];
    $quantite = $_POST["num"];
    $newQuant->setId($produitID);
    $newQuant->setQuantite($quantite);
    $newQuant->addQuantite();
    header("Location: stock.php");
}


if (isset($_POST["delete"])) {
    foreach ($produits as $produit) {
        if ($_POST["delete"] == $produit["id"]) {
            $newProd->deleteProduit($produit["id"]);
            header("Location: stock.php");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title class="font-semibold font-heading">Stock</title>
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
                <h1 class="pt-5">STOCK :</h1>
                <a href="promo.php" class="pt-5 text-white">REDUCTIONS</h2></a>
            </div>
            <table id="tab" class="mb-5">
                <thead>
                    <tr>
                        <th class="px-5 py-2 border-2 border-black bg-white w-[5%] max-md:hidden">Id produit</th>
                        <th class=" px-5 py-2 border-2 border-black bg-white">Nom</th>
                        <th class=" px-5 py-2 border-2 border-black bg-white w-[35%] max-md:hidden">Description</th>
                        <th class=" px-5 py-2 md:px-8 md:py-4 border-2 border-black bg-white max-md:hidden">Prix</th>
                        <th class="px-5 py-2 md:px-8 md:py-4 border-2 border-black bg-white">Stock</th>
                        <th class=" px-5 py-2 border-2 border-black bg-white">Modif</th>
                        <th class=" px-5 py-2 border-2 border-black bg-white">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $produit) { ?>
                        <tr>
                            <th class="px-5 py-2 border-2 border-black bg-white max-md:hidden"><?php echo $produit["id"]; ?></th>
                            <th class="px-5 py-2 border-2 border-black bg-white"><?php echo $produit["name"]; ?></th>
                            <th class="px-5 py-2 border-2 border-black bg-white max-md:hidden"><?php echo $produit["description"]; ?>
                            </th>
                            <th class="px-5 py-2 border-2 border-black bg-white max-md:hidden"><?php echo $produit["prix"]; ?> € </th>
                            <th class="px-5 py-2 border-2 border-black bg-white "><?php if (isset($produitsQuants)) {
                                                                                        foreach ($produitsQuants as $produitsQuant) {
                                                                                            if ($produitsQuant["produits_id"] == $produit["id"]) {
                                                                                                echo $produitsQuant["quantites"]; ?> / <?php
                                                                                                                                    }
                                                                                                                                }
                                                                                                                                        ?></th>
                        <?php } else {
                                                                                        print "La quantitée n'a pas encore été définie";
                                                                                    } ?>
                        <th class="px-5 py-2 border-2 border-black bg-white">
                            <form method="GET" action="modif_produit.php"><button class="bg-black text-white border-2 border-black p-2" id="modif" type="submit" name="modif" value="<?php print $produit["id"]; ?>">Modif</button></form>
                        </th>
                    
                    <th class="px-5 py-2 border-2 border-black bg-white">
                        <form action="" method="post">
                            <button class="border-2 border-black bg-[#f97316] rounded-full w-[90%] h-fit text-white" type="submit" name="delete" value="<?php print $produit["id"]; ?>">DELETE</button>
                    </th>
                    <?php  } ?>
                    </form>
                        </tr>
                </tbody>
            </table>
        </section>
        <section class="pt-5">
            <h2 class="text-center font-semibold font-heading">AJOUT :</h2>
            <form action="" method="POST" class="flex flex-col justify-between border-2 border-gray-500 rounded-lg m-5" enctype="multipart/form-data">
                <div class="flex max-md:flex-col justify-around items-center">
                    <div class="flex flex-col items-center">
                        <label for="name">Nom de l'article :</label>
                        <textarea class="border-2 border-black max-md:w-[70%]" name="name" rows="5" cols="70"></textarea>
                    </div>
                    <div class="flex flex-col items-center">
                        <label for="description">Description de l'aricle :</label>
                        <textarea class="border-2 border-black max-md:w-[70%]" name="description" rows="5" cols="70"></textarea>
                    </div>
                </div>
                <div class="flex max-md:flex-col justify-around items-center pt-5">
                    <div class="flex flex-col items-center">
                        <label for="prix">Prix de l'article :</label>
                        <input type="text" class="border-2 border-black" name="prix"></input>
                    </div>
                    <div class="flex flex-col items-center">
                        <label for="image">Image de l'article :</label><br>
                        <input type="file" name="image"><br>
                    </div>
                </div>
                <div class="flex flex-col items-center mt-2 mb-5">
                    <button class="border-2 border-black bg-[#f97316] w-[10%] rounded-full text-white text-center" type="submit" name="envoi_article">Envoyer</button>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <?php include('compo/footer.php'); ?>

    </footer>
    <script src="JS/son.js"></script>
</body>

</html>