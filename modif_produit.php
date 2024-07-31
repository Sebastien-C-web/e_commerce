<?php

require_once('config/db.php');
require_once('ressources/avis.php');
require_once('ressources/produits.php');
require_once ('ressources/produits_quantite.php');
session_start();

$db = new db();
$db->connecte();

$newProd = new Produits();
$all_prod = $newProd->getAllProduits();

$id = $_GET['modif'];

$newQuant = new ProduitsQuantites();
$produitsQuants = $newQuant->getAllQuantite();



if(isset($_POST["modif_article"])) {
    $name = $_POST["name"];
    $description = $_POST["description"];
    $image = $_FILES["image"]["name"];
    $prix = $_POST["prix"];
    $ID = $id;

    

    $newProd->modifProduit(["name" => $name, "description" => $description, "image" => $image, "prix" => $prix, "id" => $ID]);
    if (isset($image)) {
        move_uploaded_file($image["tmp_name"], "ressources/uploads/".$image["name"]);
    };
    header("Location: stock.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><title>
        <?php foreach ($all_prod as $all_prods) {
            if ($all_prods['id'] == $id) {
                print $all_prods['name'];
            }
        } ?></title>
        <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<header>
    <?php include_once('compo/header.php'); ?>
  </header>
  <main>
        <section class="bg-[#EDAC70] flex flex-col justify-center items-center gap-5 px-5 ">
        <?php foreach ($all_prod as $all_prods) {
            if ($all_prods['id'] == $id) { ?>
                <div class="flex flex-col justify-center items-center">
                    <img src="ressources/uploads/<?php echo $all_prods['image']; ?>" alt="produit numero <?php print $id ?>" class="w-40 h-fit">
                    <h2>Nom de l'article : <?php print $all_prods['name']; ?></h2>
                    <p> Description de l'article : <?php print $all_prods['description']; ?></p>
                    <h2>Prix : <?php print $all_prods['prix']; ?></h2>
                    <?php foreach($produitsQuants as $produitsQuant) { 
                        if($produitsQuant["produits_id"] == $id) { ?>
                        <h2>Quantitée en stock : <?php print $produitsQuant["quantites"]; ?></h2>
                  <?php  }
                }
                    ?>

                    <?php }} ?>
        </section>
        <section>
        <form action="" method="post" class="flex flex-col justify-between" enctype="multipart/form-data">
                <div class="flex justify-around items-center">
                    <div class="flex flex-col items-center">
                        <label for="name">Nom de l'article :</label>
                        <textarea class="border-2 border-black" name="name" rows="5" cols="70"></textarea>
                    </div>
                    <div class="flex flex-col items-center">
                        <label for="description">Description de l'aricle :</label>
                        <textarea class="border-2 border-black" name="description" rows="5" cols="70"></textarea>
                    </div>
                </div>
                <div class="flex justify-around items-center pt-5">
                    <div class="flex flex-col items-center">
                        <label for="prix">Prix de l'article :</label>
                        <input type="text" class="border-2 border-black" name="prix"></input>
                    </div>
                    <!-- <div class="flex flex-col items-center pl-24">
                        <label for="stock">Entrées en stock :</label>
                        <input type="text" class="border-2 border-black" name="stock"></input>
                    </div> -->
                    <div class="flex flex-col items-center">
                        <label for="image">Image de l'article :</label><br>
                        <input type="file" name="image" id="image"><br>
                    </div>
                    <button class="border-2 border-black bg-gray-300 w-[10%] text-center" type="submit" name="modif_article">Modifier</button>
                </div>
            </form>
        </section>
  </main>
    <footer>

    </footer>
</body>
</html>