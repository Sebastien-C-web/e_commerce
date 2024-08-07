<?php
require_once('config/db.php');
require_once('classe/panierclass.php');
require_once('ressources/produits.php');
require_once('classe/address.php');
require_once('ressources/promo.php');
ob_start();
session_start();

$newArticles = new Produits();

$newPanier = new panier();

$newAdresse = new Adresse();

$newPromo = new Promo();
$promos = $newPromo->getAllPromos();


$articles = $_SESSION['panier'];




$total = 0;



if (isset($_POST["envoiCode"])) {
    foreach ($promos as $promo) {
        if ($_POST["code"] != $promo["code"]) {
            print "Le code saisi n'est pas valide";
        } else {
            if ($promo["quantite"] < 1) {
                print "Le code saisi n'est plus valide";
                break;
            } else {
                foreach ($articles as $key => $article) {
                    $produit = $newPanier->getArticle($key);
                    if($produit["id"] == $promo["produits_id"]){
                    $reduction = $produit["prix"] * ($promo["remise"] / 100);
                    $total = $total - $reduction;
                    print "C'est bon ma gueule!";
                    var_dump($total);
                    break;
                    }
                }
            }
        }
    }
}





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



        <div class="w-full max-w-7xl px-4 md:px-5 lg-6 mx-auto">

            <h2 class="title font-manrope font-bold text-4xl leading-10 mb-8 text-center text-orange-500 mt-6">Panier articles
            </h2>
            <?php
            if (isset($_POST['plus'])) {
                $idproduit = $_POST['plus'];
                if ($_SESSION['panier'][$idproduit]) {
                    $_SESSION['panier'][$idproduit]++;
                }
            }
            if (isset($_POST['moins'])) {
                $idproduit = $_POST['moins'];
                if ($_SESSION['panier'][$idproduit]) {
                    $_SESSION['panier'][$idproduit]--;
                    header("Location:panier.php", true, 303);
                    ob_clean();
                    if ($_SESSION['panier'][$idproduit] == 0) {
                        header("Location:delPanier.php?id=$idproduit", true, 303);
                        ob_clean();
                    }
                }
            }

            foreach ($articles as $key => $article) {


                /* var_dump($article); */
                $produit = $newPanier->getArticle($key);
                /* var_dump($produit); */
                $total += ($produit['prix'] * $article);
            ?>

                <div class="rounded-3xl border-2 border-gray-200 p-4 lg:p-8 grid grid-cols-12 mb-8 max-lg:max-w-lg max-lg:mx-auto gap-y-4 ">
                    <div class="col-span-12 lg:col-span-2 img box">
                        <img src="ressources/uploads/<?php echo $produit['image'] ?>" alt="image" class="max-lg:w-full lg:w-[180px] rounded-lg">
                    </div>
                    <div class="col-span-12 lg:col-span-10 detail w-full lg:pl-3">
                        <div class="flex items-center justify-between w-full mb-4">
                            <h5 class="font-manrope font-bold text-2xl leading-9 text-gray-900"><?php echo $produit['name'] ?> </h5>
                            <form method="post" action="delPanier.php?id=<?php print $produit["id"] ?>">
                                <button type="submit" name="supprimer" class="rounded-full group flex items-center justify-center focus-within:outline-red-500">
                                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle class="fill-red-50 transition-all duration-500 group-hover:fill-red-400" cx="17" cy="17" r="17" fill="" />
                                        <path class="stroke-red-500 transition-all duration-500 group-hover:stroke-white" d="M14.1673 13.5997V12.5923C14.1673 11.8968 14.7311 11.333 15.4266 11.333H18.5747C19.2702 11.333 19.834 11.8968 19.834 12.5923V13.5997M19.834 13.5997C19.834 13.5997 14.6534 13.5997 11.334 13.5997C6.90804 13.5998 27.0933 13.5998 22.6673 13.5997C21.5608 13.5997 19.834 13.5997 19.834 13.5997ZM12.4673 13.5997H21.534V18.8886C21.534 20.6695 21.534 21.5599 20.9807 22.1131C20.4275 22.6664 19.5371 22.6664 17.7562 22.6664H16.2451C14.4642 22.6664 13.5738 22.6664 13.0206 22.1131C12.4673 21.5599 12.4673 20.6695 12.4673 18.8886V13.5997Z" stroke="#EF4444" stroke-width="1.6" stroke-linecap="round" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        <p class="font-normal text-base leading-7 text-gray-500 mb-6"><?php echo $produit['description'] ?> <a href="javascript:;" class="text-indigo-600"></a>
                        </p>
                        <div class="flex justify-between items-center">
                            <div class="flex items-center gap-4">
                                <form action="" method="post">
                                    <button type="submit" name="moins" value="<?php print $produit["id"] ?>" class="group rounded-[50px] border border-gray-200 shadow-sm shadow-transparent p-2.5 flex items-center justify-center bg-white transition-all duration-500 hover:shadow-gray-200 hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300">
                                        <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black" width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.5 9.5H13.5" stroke="" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>
                                <input type="text" id="number" class="border border-gray-200 rounded-full w-10 aspect-square outline-none text-gray-900 font-semibold text-sm py-1.5 px-3 bg-gray-100  text-center" placeholder="<?php echo $article ?>">
                                <form action="" method="post">
                                    <button type="submit" name="plus" value="<?php print $produit["id"] ?>" class="group rounded-[50px] border border-gray-200 shadow-sm shadow-transparent p-2.5 flex items-center justify-center bg-white transition-all duration-500 hover:shadow-gray-200 hover:bg-gray-50 hover:border-gray-300 focus-within:outline-gray-300">
                                        <svg class="stroke-gray-900 transition-all duration-500 group-hover:stroke-black" width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.75 9.5H14.25M9 14.75V4.25" stroke="" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <h6 class="text-orange-500 font-manrope font-bold text-2xl leading-9 text-right"><?php echo $produit['prix'] ?></h6>
                        </div>
                    </div>
                </div>
            <?php
            } ?>

            <div class="flex flex-row justify-end pr-10">
                <?php if (isset($reduction)) { ?>
                    <p> - <?php print $reduction ?> €</p>
                <?php  } ?>
            </div>

            <div class="flex flex-col md:flex-row items-center md:items-center justify-between lg:px-6 pb-6 border-b border-gray-200 max-lg:max-w-lg max-lg:mx-auto">
                <h5 class="text-orange-500 font-manrope font-semibold text-2xl leading-9 w-full max-md:text-center max-md:mb-4">Total</h5>

                <div class="flex items-center justify-between gap-5 ">
                    <button class="rounded-full py-2.5 px-3 bg-indigo-50 text-orange-500 font-semibold text-xs text-center whitespace-nowrap transition-all duration-500" id="btnCode">Promo
                        Code?</button>
                    <h6 class="font-manrope font-bold text-3xl lead-10 text-orange-500"><?php print $total ?></h6>
                </div>
            </div>

            <div id="promo" class="my-5 hidden">
                <form action="" method="POST" class="flex flex-col justify-center items-center gap-5">
                    <div>
                        <label for="code">Entrez ici votre code de réduction : </label>
                        <input type="text" class="border-2 border-black" name="code"></input>
                    </div>
                    <div class="flex flex-row jutify-center">
                        <button id="btnSub" type="submit" name="envoiCode" class="border-2 border-black bg-[#f97316] w-[130%] rounded-full text-white text-center">Envoyer</button>
                    </div>
                </form>
            </div>

            <div class="max-lg:max-w-lg max-lg:mx-auto">
                <p class="font-normal text-base leading-7 text-orange-500 text-center mb-5 mt-6">Taxes d’expédition et remises calculées à la caisse</p>

            </div>
        </div>
        <form method="post" action="checkout.php" class="flex h-screen">
            <div class="m-auto">


                <h1 class="inline text-2xl font-semibold leading-none">Adresse de livraison</h1>

                <div class="flex-none pt-2.5 pr-2.5 pl-1"></div>

                <div class="px-5 pb-5">
                    <input required placeholder="adresse" name="adresse_1" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"><input placeholder="Address suite" name="adresse_suite" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                    <div class="flex">
                        <div class="flex-grow w-1/4 pr-2"><input type="number" required placeholder="code postal" name="codepostal" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></div>
                        <div class="flex-grow"><input required placeholder="ville" name="ville" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-800 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400"></div>
                    </div>

                </div>
                <hr class="mt-4">
                <div class="flex flex-row-reverse p-3">
                    <div class="flex-initial pl-3">
                        <button type="submit" name="ajouter" class="rounded-full py-5 px-36 bg-orange-500 text-white font-semibold text-lg w-full text-center transition-all duration-500 hover:bg-green-700 ">procéder au paiement</button>
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FFFFFF">
                            <path d="M0 0h24v24H0V0z" fill="none"></path>
                            <path d="M5 5v14h14V7.83L16.17 5H5zm7 13c-1.66 0-3-1.34-3-3s1.34-3 3-3 3 1.34 3 3-1.34 3-3 3zm3-8H6V6h9v4z" opacity=".3"></path>
                            <path d="M17 3H5c-1.11 0-2 .9-2 2v14c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V7l-4-4zm2 16H5V5h11.17L19 7.83V19zm-7-7c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3zM6 6h9v4H6z"></path>
                        </svg>

                        </button>

                    </div>

                </div>

        </form>
        </div>








    </section>

    <footer class="pt-[10%]">
        <?php include('compo/footer.php'); ?>
    </footer>
    <script src="JS/script_panier.js"></script>
</body>

</html>