<?php 
require_once('./config/db.php');
require_once('ressources/avis.php');
require_once('ressources/produits.php');
require_once('ressources/produits_quantite.php');
require_once('ressources/taille.php');
require_once("classe/users.php");
require_once('classe/panierclass.php');
session_start();


$newPanier = new panier();
$newArticles = new Produits();
$total = 0;
$sql = new db();
$sql->connecte();
$newProd = new Produits();
$all_prod = $newProd->getAllProduits();
$newAvis = new Avis();
$newTaille = new Taille();
$taille = $newTaille->getAllTaille();
$id = $_GET['id'];
$newQty = new ProduitsQuantites();
$qty = $newQty->getAllQuantite();
$message_avis = null;

// var_dump($_SESSION["panier"]);

if (isset($_SESSION['user'])) {
    $all_avis_users = $newAvis->getAvisUser($_SESSION['user']['id'], $id);
}

$avis_prod = $newAvis->getAvisId($id);
$all_note = $newAvis->getAllNotes($id);

$newUser = new Users();
$all_users = $newUser->getAllUsers();

$n = 2;

if (isset($_POST['addAvis'])) {

    if ($all_avis_users) {
        $message_avis = "Vous avez deja posté un avis.";
    } else {
        $note = $_POST['note'];
        var_dump($_POST['note']);
        $contenu = htmlspecialchars(trim($_POST['avisNote']));
        $produit_id = $id;
        $user_id = $_SESSION['user']['id'];
        $newAvis->setNote($note);
        $newAvis->setContenu($contenu);
        $newAvis->setProduitId($produit_id);
        $newAvis->setUsersId($user_id);
        $newAvis->addAvis();
        $newAvis->addAvisUsers(['users_id' => $user_id, 'produit_id' => $produit_id]);
        header('location: produit.php?id=' . $id);
    }
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php foreach ($all_prod as $all_prods) {
            if ($all_prods['id'] == $id) {
                print $all_prods['name'];
            }
        }
        ?>
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="ressources/style_etoile.css">
    <link rel="stylesheet" href="CSS/style_panier.css">
  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
</head>

<body>
    <header>
        <?php include_once('compo/header.php'); ?>
    </header>
    <main>

        <section class="bg-[#EDAC70]">
            <div class="container mx-auto">
                <?php foreach ($all_prod as $all_prods) {
                    if ($all_prods['id'] == $id) { ?>
                        <div class=" flex flex-col md:flex-row justify-center items-center py-6">
                            <img src="ressources/uploads/<?php print $all_prods['image']; ?>" alt="produit numero <?php print $id ?>" class="max-md:w-72 max-md:h-72 lg:w-fit lg:h-96 object-cover max-md:mx-2">

                            <div class="flex flex-col items-center justify-center md:justify-around mx-6 ">
                                <div class="">
                                    <h2 class="text-4xl font-semibold uppercase underline"><?php print $all_prods['name']; ?></h2>
                                </div>

                                <p><?php print $all_prods['description']; ?></p>
                                <h2 class="text-4xl font-semibold text-red-500"><?php print $all_prods['prix']; ?>&euro; TTC</h2>



                                <form action="addPanier.php?id=<?php print $id; ?>" method="post">
                                    <label for="qty"> Quantités </label>
                                   
                                 
                                    <select name="qty" required>
                                        
                                        <?php foreach ($qty as $qtys) {
                                            if ($qtys['produits_id'] == $id) {
                                                 for ($i = 1; $i < ($qtys['quantites'] + 1); $i++) { ?>

                                                        <option value="<?php print $i ?>"><?php print $i ?></option>
                                        <?php }
                                                }
                                            }
                                         ?>

                                    </select>
                                   
                                    <button type="submit" value="<?php print $all_prods['id']; ?>" class="p-2 border border-black bg-white">Ajouter au panier</button>
                                </form>
                            </div>
                        </div>
                <?php }}
                 ?>
            </div>
        </section>

        <section class="container mx-auto">
            <div class="flex justify-center items-center">
                <h3>La moyenne de cet article de fou est de : <span id="average"><?php print number_format($all_note['AVG(note)'], 1, ","); ?></span>
                    <div class="flex justify-center items-center">
                        <form action="" method="post" id="etoileNote1">
                            <input type="hidden" name="note1" value="<?php print number_format($all_note['AVG(note)'], 0, ","); ?>" />
                            <span class="etoile1">★</span>
                            <span class="etoile1">★</span>
                            <span class="etoile1">★</span>
                            <span class="etoile1">★</span>
                            <span class="etoile1">★</span>
                        </form>
                    </div>

                </h3>
            </div>


            <?php if (isset($_SESSION['user']) && (!$all_avis_users)) {
            ?>


                <form action="" method="post" id="etoileNote">
                    <div class="flex justify-center items-center">
                        <div class="flex flex-col justify-center items-center">
                            <h2 class="text-2xl">Notez cet article incroyable (Pas en dessous de 4)</h2>
                            <div>
                                <input type="hidden" name="note" value="5" />
                                <span class="etoile">★</span>
                                <span class="etoile">★</span>
                                <span class="etoile">★</span>
                                <span class="etoile">★</span>
                                <span class="etoile">★</span>
                            </div>
                        </div>

                    </div>
                    <div class="flex flex-col justify-center items-center">
                        <textarea name="avisNote" id="" placeholder="Donnez votre avis !" class="w-[80%] h-96 border border-black"></textarea>
                        <button type="submit" name="addAvis" value="<?php print $all_prods['id']; ?>" <?php $all_avis_users ? print "disabled='true'" : print ""; ?> class="p-2 border border-black mt-2">Je donne mon avis</button>
                        <?php if ($message_avis != null) { ?>
                            <p><?php print $message_avis; ?></p>
                    <?php }
                    } ?>
                    </div>
                </form>
                <div class="flex flex-col justify-center items-center">
                    <p class="text-2xl font-semibold">Les avis de notre commu' </p>
                    <p class="text-sm">(prix +50% pour les notes en dessous de 5)</p>
                </div>

                <?php foreach ($avis_prod as $avis_prods) {
                    foreach ($all_users as $all_user) {
                        if ($all_user['id'] == $avis_prods['users_id']) { ?>

                            <h3 class="text-xl font-semibold text-center underline">
                                <?php print $all_user['name'] ?> :
                            </h3>
                            <div class="flex justify-center my-2">
                                <article class="mx-2">
                                    <?php print $avis_prods['contenu']; ?>
                                    <div class="flex justify-center ">
                                        <form action="" method="post" id="etoileNote<?php print $n ?>">
                                            <input type="hidden" class="etoiles" id="<?php print $n ?>" name="note2" value="<?php print $avis_prods['note']; ?>" />
                                            <span class="etoile<?php print $n ?> cool">★</span>
                                            <span class="etoile<?php print $n ?> cool">★</span>
                                            <span class="etoile<?php print $n ?> cool">★</span>
                                            <span class="etoile<?php print $n ?> cool">★</span>
                                            <span class="etoile<?php print $n ?> cool">★</span>
                                        </form>
                                    </div>

                                </article>

                            </div>
                            <hr />

                <?php $n++;
                        }
                    }
                } ?>
                <div>

                </div>

        </section>



    </main>
    <footer>
        <?php include_once('compo/footer.php'); ?>
    </footer>
    <script src="ressources/script_etoile.js"></script>


    <script>
document.addEventListener('DOMContentLoaded', function() {
  const menuButton = document.getElementById('menu-button');
  const navigation = document.getElementById('navigation');

  menuButton.addEventListener('click', function() {
      navigation.classList.toggle('hidden');
  });
});
    </script>     


</body>

</html>