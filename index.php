<?php
require_once('ressources/produits.php');
require_once('config/db.php');
session_start();

$bdd = new db();
$bdd->connecte();

$newProd = new Produits();
$produits = $newProd->getAllProduits();
$_SESSION["rowguid"]=uniqid();

$randomProd = array_rand($produits, 2);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>home</title>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <link rel="stylesheet" href="url-to-cdn/splide.min.css">
</head>

<body>
    <embed width="10" height="10" src="imagelog/son12.mp3" loop="false" autostart="true" hidden="true">

    <header>
        <?php include('compo/header.php'); ?>
    </header>
    <main>
        <section class="bg-[#EDAC70]">
            <article class="splide" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                    <ul class="splide__list ">
                        <?php foreach ($produits as $key => $produit) {
                            if ($key == $randomProd[0]) { ?>
                                <li class="splide__slide flex flex-row justify-center items-center gap-36 my-5">
                                    <div>
                                        <img class="w-96 max-h-96" src="ressources/uploads/<?php echo $produit["image"]; ?>">
                                    </div>
                                    <div class="flex flex-col gap-36">
                                        <h1 class="text-4xl font-bold"><?php print $produit["name"]; ?></h1>
                                        <h2 class="text-2xl"><?php print $produit["description"]; ?></h2>
                                        <h2 class="text-4xl font-extrabold text-white">Seulement <?php print $produit["prix"]; ?> € ! </h2>
                                    </div>
                                </li>
                            <?php }
                            if ($key == $randomProd[1]) { ?>
                                <li class="splide__slide flex flex-row justify-center items-center gap-36 my-5">
                                    <div>
                                        <img class="w-96 h-fit" src="ressources/uploads/<?php echo $produit["image"]; ?>">
                                    </div>
                                    <div class="flex flex-col gap-36">
                                        <h1 class="text-4xl font-bold"><?php print $produit["name"]; ?></h1>
                                        <h2 class="text-2xl"><?php print $produit["description"]; ?></h2>
                                        <h2 class="text-4xl font-extrabold text-white">Seulement <?php print $produit["prix"]; ?> € ! </h2>
                                    </div>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </div>
            </article>
        </section>
        <section>
            <?php foreach ($produits as $produit) { ?>
                <article>

                </article>
            <?php } ?>
        </section>
    </main>

    <footer>
        <?php include('compo/footer.php'); ?>
    </footer>
    <script>
        new Splide('.splide').mount();
    </script>
</body>

</html>