<?php
require_once('ressources/produits.php');
require_once('config/db.php');
require_once('classe/panierclass.php');
session_start();

$bdd = new db();
$bdd->connecte();
$newPanier = new panier();
$newProd = new Produits();
$total = 0;
$produits = $newProd->getAllProduits();
if (!isset($_SESSION["rowguid"])) {
    $_SESSION["rowguid"] = uniqid();
}

$lastProds = $newProd->lastProduits();

if (count($produits) > 2) {
    $randomProd = array_rand($produits, 3);
}


if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();

}


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>home</title>
    <link rel="stylesheet" href="CSS/style_panier.css">
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <link rel="stylesheet" href="url-to-cdn/splide.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</head>
<body>




 <embed width="10" height="10" src="imagelog/son12.mp3" loop="false" autostart="true" hidden="true">



<header>
        <?php include_once('compo/header.php'); ?>
    </header>



   

     
    <main>
        <section class="bg-[#EDAC70]">
            <div class="flex justify-center items-center underline">
                <h1 class="text-2xl font-bold text-red-700">Nos produits phares : </h1>
            </div>
            <article class="splide" aria-label="Splide Basic HTML Example">
                <div class="splide__track">
                    <ul class="splide__list ">
                        <?php if (count($produits) < 3) {
                            print "Pas assez de produits en base.";
                        } else {
                            foreach ($produits as $key => $produit) {
                                if ($key == $randomProd[0]) { ?>
                                    <li class="splide__slide flex flex-row justify-center items-center gap-36 my-5">
                                        <div>
                                            <a href="produit.php?id=<?php print $produit["id"]; ?>"><img class="w-96 max-h-96" src="ressources/uploads/<?php echo $produit["image"]; ?>"> </a>
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
                                        <a href="produit.php?id=<?php print $produit["id"]; ?>"><img class="w-96 max-h-96" src="ressources/uploads/<?php echo $produit["image"]; ?>"></a>
                                        </div>
                                        <div class="flex flex-col gap-36">
                                            <h1 class="text-4xl font-bold"><?php print $produit["name"]; ?></h1>
                                            <h2 class="text-2xl"><?php print $produit["description"]; ?></h2>
                                            <h2 class="text-4xl font-extrabold text-white">Seulement <?php print $produit["prix"]; ?> € ! </h2>
                                        </div>
                                    </li>
                                <?php }
                                if ($key == $randomProd[2]) { ?>
                                    <li class="splide__slide flex flex-row justify-center items-center gap-36 my-5">
                                        <div>
                                        <a href="produit.php?id=<?php print $produit["id"]; ?>"><img class="w-96 max-h-96" src="ressources/uploads/<?php echo $produit["image"]; ?>"></a>
                                        </div>
                                        <div class="flex flex-col gap-36">
                                            <h1 class="text-4xl font-bold"><?php print $produit["name"]; ?></h1>
                                            <h2 class="text-2xl"><?php print $produit["description"]; ?></h2>
                                            <h2 class="text-4xl font-extrabold text-white">Seulement <?php print $produit["prix"]; ?> € ! </h2>
                                        </div>
                                    </li>
                                <?php } ?>
                            <?php }; ?>
                        <?php }; ?>
                    </ul>
                </div>
            </article>
        </section>
        <section class="flex flex-row justify-around my-10">
            <?php if (count($produits) < 3) {
                print "Pas assez de produits en base.";
            } else {
                foreach ($lastProds as $lastProd) { ?>
                    <article>
                        <div class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                                <img class="rounded-t-lg w-96 h-96" src="ressources/uploads/<?php echo $lastProd["image"]; ?>" alt="produit 1" />
                            <div class="p-5">
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-bold truncate tracking-tight text-gray-900 dark:text-white"><?php print $lastProd["name"]; ?></h5>
                                </a>
                                <p class="mb-3 font-normal max-h-10 truncate text-gray-700 dark:text-gray-400"><?php print $lastProd["description"]; ?></p>
                                <a href="produit.php?id=<?php print $lastProd["id"]; ?>"  class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Infos
                                    <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php } ?>
            <?php } ?>
        </section>
    </main>

    <footer>
        <?php include('compo/footer.php'); ?>
    </footer>
    <script>
        new Splide('.splide').mount();
    
    </script>  
    <script src="JS/son.js"></script>         
</body>

</html>