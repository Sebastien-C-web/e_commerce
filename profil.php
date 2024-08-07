<?php

require_once('./config/db.php');
require_once('classe/users.php');
require_once('classe/commande.php');
require_once('ressources/produits.php');
session_start();
$sql = new db();
$sql->connecte();

$newCommande = new Commande();
$all_commande = $newCommande->getAllCommande($_SESSION['user']['id']);
$all_commande_prod = $newCommande->getAllCommandeArticle();
// print '<pre>';
// var_dump($all_commande);
// print '<pre>';

$newProd = new Produits();
$all_prod = $newProd->getAllProduits();


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="ressources/style_etoile.css">
    <link rel="stylesheet" href="css/prix.css">
</head>

<body>
    <header>
        <?php include_once('compo/header.php'); ?>
    </header>
    <main>
        <section class="bg-[#EDAC70] h-[20vh]">
            <div class="container mx-auto">
                <article class=" flex flex-col justify-center items-center h-[20vh]">
                    <h2 class="text-xl font-semibold">Nom : <?php print $_SESSION['user']['name'] ?></h2>
                    <p class="text-xl font-semibold">Email : <?php print $_SESSION['user']['email'] ?></p>
                    <p>Statut : <?php print $_SESSION['user']['statut'] ?></p>
                </article>

            </div>
        </section>
        <div class="container mx-auto">
            <article>
                <h2 class="text-xl text-center">Dernières commandes :</h2>
                <?php foreach ($all_commande as $commandes) { ?>
                    <article class="border border-gray-200 bg-gray-200 mb-4">

                        <div class="flex justify-center gap-[5%] my-6">
                            <p>Numero de commande : <?php print $commandes['numerodecommande']; ?></p>
                            <p>Date : <?php print $commandes['date']; ?></p>

                        </div>
                        <h2 class="text-xl text-center">Articles : </h2>
                        <div class="flex justify-center">

                            <?php foreach ($all_commande_prod as $all_commande_prods) {
                                foreach ($all_prod as $produits) {
                                    if ($all_commande_prods['produits_id'] == $produits['id'] && $all_commande_prods['numerodecommande'] == $commandes['numerodecommande']) { ?>
                                        <div class="mx-4">
                                            <p class="text-xl font-semibold"><?php print $produits['name'] ?></p>
                                            <img class="w-52 h-52 object-cover" src="ressources/uploads/<?php print $produits['image'] ?>" alt="image produit">
                                            <p>Quantité : <?php print $all_commande_prods['qty'] ?></p>
                                            <h2 class="text-xl"><?php print $produits['prix'] ?>&euro;</h2>
                                        </div>
                            <?php }
                                }
                            } ?>
                        </div>
                        <div class="ouaisouais">
                            <p class="text-xl font-semibold prixdefou m-6">Total : <?php print $commandes['total'] ?>&euro;</p>
                        </div>


                    </article>
                <?php } ?>
            </article>
        </div>

    </main>
</body>

</html>