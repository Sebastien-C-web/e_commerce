<?php
require_once('./config/db.php');
require_once('ressources/avis.php');
require_once('ressources/produits.php');
session_start();

$sql = new db();
$sql->connecte();

$newProd = new Produits();
$all_prod = $newProd->getAllProduits();
$newAvis = new Avis();
$all_avis_users = $newAvis->getAllAvisUsers();
$id = $_GET['id'];
$message_avis = null;

if (isset($_POST['addAvis'])) {

    foreach ($all_avis_users as $all_avis_user) {
        foreach ($all_prod as $all_prods) {
            if ($_SESSION['user']['id'] == $all_avis_user['id'] && $all_prods['id'] == $id && $all_avis_user['vote'] == true) {
                $message_avis = "Vous avez deja posté un avis.";
                exit;
            }
        }
    }
    $note = $_POST['note'];
    $contenu = htmlspecialchars(trim($_POST['avisNote']));
    $produit_id = $id;
    $user_id = $_SESSION['user']['id'];
    $newAvis->setNote($note);
    $newAvis->setContenu($contenu);
    $newAvis->setProduitId($produit_id);
    $newAvis->setUsersId($user_id);
    $newAvis->addAvis();
    $newAvis->addAvisUsers(['users_id' => $user_id, 'produit_id' => $produit_id]);
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
</head>

<body>
    <main class="container mx-auto">
        <?php foreach ($all_prod as $all_prods) {
            if ($all_prods['id'] == $id) { ?>
                <div class="flex flex-col justify-center items-center">
                    <img src="<?php print $all_prods['image']; ?>" alt="produit numero <?php print $id ?>" class="w-40 h-fit">
                    <h2><?php print $all_prods['name']; ?></h2>
                    <p><?php print $all_prods['description']; ?></p>
                    <h2><?php print $all_prods['prix']; ?></h2>
                    <form action="" method="post">
                        <button type="submit" value="<?php print $all_prods['id']; ?>" class="p-2 border border-black">Ajouter au panier</button>
                    </form>
                </div>
                <?php // if (isset($_SESSION['user'])) { 
                ?>
                <div class="flex flex-col justify-center items-center">
                    <form method="post" action="#" id="etoileNote">
                        <input type="hidden" name="note" value="4">
                        <span class="etoile">★</span>
                        <span class="etoile">★</span>
                        <span class="etoile">★</span>
                        <span class="etoile">★</span>
                        <span class="etoile">★</span>
                    </form>
                </div>
                <form action="" method="post">
                    <div class="flex flex-col justify-center items-center">
                        <textarea name="avisNote" id="" placeholder="Donnez votre avis !" class="w-[80%] h-96 border border-black"></textarea>
                        <button type="submit" name="addAvis" value="<?php print $all_prods['id']; ?>" class="p-2 border border-black mt-2">Je donne mon avis</button>
                        <?php if ($message_avis != null) { ?>
                            <p><?php print $message_avis; ?></p>
                        <?php } ?>
                    </div>
                </form>

        <?php }
        }
        // } 
        ?>
    </main>
    <script src="ressources/script_etoile.js"></script>
</body>

</html>