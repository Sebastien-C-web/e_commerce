<?php
require_once('config/db.php');
require_once('classe/panierclass.php');
require_once('ressources/produits.php');
session_start();

$newArticles = new Produits();
$newPanier = new panier();
$articles = $_SESSION['panier'];

var_dump($articles);




?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Panier</title>
</head>

<body>

    <nav>
        <?php include('compo/header.php'); ?>
    </nav>

    <section>
        <div class="container mx-auto">

        <h2 class="text-bold flex justify-center items-center uppercase font-bold text-orange-400 pb-6 pt-6">Mon panier</h2>

        <table class="border border-2 border-black mt-4">

            <thead>

                <th></th>
                <th class="border border border-2 border-black">Produit</th>
                <th class="border border border-2 border-black">Prix</th>
                <th class="border border border-2 border-black">Quantite</th>
                <th class="border border border-2 border-black">Action</th>
                <th class="border border border-2 border-black" >Total</th>

            </thead>
            <tbody>
                <?php
                foreach ($articles as $key => $article) {
                   /* var_dump($article); */
                    $produit = $newPanier->getArticle($key);
                    /* var_dump($produit); */
                ?>

                    <tr>
                        <td class="border border-2 border-black"><img class="h-[7%] w-[7%]" src="<?php echo $produit['image'] ?>" alt="Image du produit"></td>
                        <td class="border border-2 border-black"><?php echo $produit['name'] ?></td>
                        <td class="border border-2 border-black"><?php echo $produit['prix'] ?></td>
                        <td class="border border-2 border-black"><?= $article ?></td>
                        <td class="border border-2 border-black"><a href="delPanier.php?id=<?php print $produit["id"] ?>"><img class="w-[7%] h-[7%]" src="iconepoubelle.webp" alt="icone poubelle"></a></td>

                    </tr>
                <?php
                } ?>
            </tbody>
        </table>
        </div>

    </section>

</body>

</html>