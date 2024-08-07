<?php

require_once('config/db.php');
require_once('ressources/avis.php');
require_once('ressources/produits.php');
require_once('ressources/produits_quantite.php');
require_once('ressources/taille.php');
session_start();


$db = new db();
$db->connecte();

$newProd = new Produits();
$all_prod = $newProd->getAllProduits();

$id = $_GET['modif'];

$newQuant = new ProduitsQuantites();
$produitsQuants = $newQuant->getAllQuantite();

$newTaille = new Taille();
$produitsTailles = $newTaille->getAllTaille();

if(isset($_POST["change"])){


    $taille = $_POST["taille"];
    $tailleID = $taille;

    $produitID = $_POST["change"];
    $quantite = $_POST["num"];
    $newQuant->setId($produitID);
    $newQuant->setQuantite($quantite);
    $newQuant->setTailleId($tailleID);
    $newQuant->addQuantite();



    // $produit_id = $_POST["change"];

    // $taille = $_POST["taille"];
    // $tailleID = $taille;

    // $newQuant->setId($produitID);
    // $newQuant->setTailleId($tailleID); 
    // $newQuant->addTaille();
    header("Location:stock.php");
}

// if (isset($_POST["qtte"])) {
//     $produitID = $_POST["qtte"];
//     $quantite = $_POST["num"];
//     $newQuant->setId($produitID);
//     $newQuant->setQuantite($quantite);
//     $newQuant->addQuantite();
    // header("Location: stock.php");
// }

if (isset($_POST["modif_article"])) {

    $imgInfos = $_FILES["image"]["name"];

    $name = $_POST["name"];
    $description = $_POST["description"];
    $image = $imgInfos. "_". time();
    $prix = $_POST["prix"];
    $ID = $id;

    $newProd->modifProduit(["name" => $name, "description" => $description, "image" => $image, "prix" => $prix, "id" => $ID]);
    if (isset($image)) {
        move_uploaded_file($_FILES["image"]["tmp_name"], "ressources/uploads/" .$image);
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
        <section class="bg-[#EDAC70] flex flex-row justify-center items-center gap-5 px-5 py-5">
        <?php foreach ($all_prod as $all_prods) {
                    if ($all_prods['id'] == $id) { ?>
            <article>
                
                        <div class="flex flex-col justify-center pr-10 items-center">
                            <img src="ressources/uploads/<?php echo $all_prods['image']; ?>" alt="produit numero <?php print $id ?>" class="w-40 h-fit">
                        </div>
                        <div class="flex flex-col justify-center items-center">
                            <h2>Nom de l'article : <?php print $all_prods['name']; ?></h2>
                            <p> Description de l'article : <?php print $all_prods['description']; ?></p>
                            <h2>Prix : <?php print $all_prods['prix']; ?> € </h2>
                            <?php foreach ($produitsQuants as $produitsQuant) {
                                if ($produitsQuant["produits_id"] == $id) { ?>
                                    <h2>Quantitée en stock : <?php print $produitsQuant["quantites"]; ?></h2>
                            <?php  }
                            }
                            ?>
                            <h2>Tailles disponibles :<?php if(isset($produitsQuants)) {
                                                                                        foreach ($produitsQuants as $produitsQuant) {
                                                                                            if ($produitsQuant["produits_id"] == $id) {
                                                                                                foreach($produitsTailles as $produitsTaille) {
                                                                                                    if($produitsQuant["taille_id"] == $produitsTaille["id"]){
                                                                                                        echo $produitsTaille["taille"];?> / <?php
                                                                                                    }
                                                                                                }
                                                                                            }
                                                                                        }      ?>
                        </div>
                <?php }
                
              ?>
            </article>
            <article class="ml-24 flex flex-col items-center justify-center">
                <form action="" method="post" class="flex flex-col items-center justify-center gap-2">
                <div class="flex flex-col items-center justify-center">
                    <label for="taille">Taille l'article :</label><br>
                    <select name="taille">
                        <option value="">Veuillez choisir la taille souhaitée</option>
                        <?php foreach($produitsTailles as $produitsTaille){ ?>
                        <option value="<?php
                            echo $produitsTaille["id"];?>"
                         > <?php echo $produitsTaille["taille"]; } ?> </option>
                    </select>
                </div>
                <div class="flex flex-row gap-2">
                <label for="num">Nouveau stock : </label>
                <input type="text" class="border-2 border-black w-[50%] mr-5" name="num" required>
                </div>
                <div class="flex flex col items-center justify-center">
                <button class="border-2 border-black bg-gray-300 text-center" type="submit" name="change" value="<?php echo $all_prods["id"] ?>">Envoyer</button>
                </div>
                </form>
            </article>
            <?php } } ?>
        </section>
        <section>
            <form action="" method="post" class="flex flex-col justify-between border-2 border-gray-500 rounded-lg p-5 m-5" enctype="multipart/form-data">
                <div class="flex max-md:flex-col justify-around items-center">
                    <div class="flex flex-col items-center">
                        <label for="name">Nom de l'article :</label>
                        <textarea class="border-2 border-black max-md:w-[70%]" name="name" rows="5" cols="70"><?php foreach ($all_prod as $all_prods) {
                                                                                                    if ($all_prods['id'] == $id) {
                                                                                                        print $all_prods["name"];
                                                                                                    }
                                                                                                } ?></textarea>
                    </div>
                    <div class="flex flex-col items-center">
                        <label for="description">Description de l'aricle :</label>
                        <textarea class="border-2 border-black max-md:w-[70%]" name="description" rows="5" cols="70"><?php foreach ($all_prod as $all_prods) {
                                                                                                            if ($all_prods['id'] == $id) {
                                                                                                                print $all_prods["description"];
                                                                                                            }
                                                                                                        } ?></textarea>
                    </div>
                </div>
                <div class="flex max-md:flex-col justify-around items-center pt-5">
                    <div class="flex flex-col items-center">
                        <label for="prix">Prix de l'article :</label>
                        <input type="text" class="border-2 border-black" name="prix" value=<?php foreach ($all_prod as $all_prods) {
                                                                                                if ($all_prods['id'] == $id) {
                                                                                                    print $all_prods["prix"];
                                                                                                }
                                                                                            } ?>></input>
                    </div>
                    <div class="flex flex-col items-center">
                        <label for="image">Image de l'article :</label><br>
                        <input type="file" name="image" id="image"><br>
                    </div>
                    <button class="border-2 border-black bg-[#f97316] w-[10%] rounded-full text-white text-center" type="submit" name="modif_article">Modifier</button>
                </div>
            </form>
        </section>
    </main>

    <footer>
        <?php include('compo/footer.php'); ?>
    </footer>
</body>

</html>