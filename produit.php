<?php require_once('./config/db.php');
require_once('ressources/avis.php');
require_once('ressources/produits.php');
session_start();
$sql = new db();
$sql->connecte();

$newProd = new Produits();
$all_prod = $newProd->getAllProduits();
$newAvis = new Avis();
$id = $_GET['id'];
$message_avis = null;
if (isset($_SESSION['user'])) {
    $all_avis_users = $newAvis->getAvisUser($_SESSION['user']['id'], $id);
}

$avis_prod = $newAvis->getAvisId($id);
$all_note = $newAvis->getAllNotes($id);

$newUser = new Users();
$all_users = $newUser->getAllUsers();

$n=2;

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
        header('location: produit.php?id='.$id);
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
                        <div class=" flex justify-center py-6">
                            <img src="<?php print $all_prods['image']; ?>" alt="produit numero <?php print $id ?>" class="w-fit h-96">

                            <div class="flex flex-col items-center justify-around mx-6 ">
                                <div class="">
                                    <h2 class="text-4xl font-semibold uppercase underline"><?php print $all_prods['name']; ?></h2>
                                </div>

                                <p><?php print $all_prods['description']; ?></p>
                                <h2 class="text-4xl font-semibold text-red-500"><?php print $all_prods['prix']; ?>&euro; TTC</h2>
                                <form action="" method="post">
                                    <button type="submit" value="<?php print $all_prods['id']; ?>" class="p-2 border border-black bg-white">Ajouter au panier</button>
                                </form>
                            </div>
                        </div>
                <?php }
                } ?>
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

                        <input type="hidden" name="note" value="5" />
                        <span class="etoile">★</span>
                        <span class="etoile">★</span>
                        <span class="etoile">★</span>
                        <span class="etoile">★</span>
                        <span class="etoile">★</span>
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
                <?php foreach ($avis_prod as $avis_prods) {
                    foreach ($all_users as $all_user) {
                        if ($all_user['id'] == $avis_prods['users_id']) { ?>
                            <div class="flex ">
                                <h3>
                                    <?php print $all_user['name'] ?> :
                                </h3>
                                <article class="ml-2">
                                    <?php print $avis_prods['contenu']; ?></br>note: <?php print $avis_prods['note']; ?>/5
                                    <form action="" method="post" id="etoileNote<?php print $n ?>">
                                        <input type="hidden" class="etoiles" id="<?php print $n ?>" name="note2" value="<?php print $avis_prods['note']; ?>" />
                                        <span class="etoile<?php print $n ?> cool">★</span>
                                        <span class="etoile<?php print $n ?> cool">★</span>
                                        <span class="etoile<?php print $n ?> cool">★</span>
                                        <span class="etoile<?php print $n ?> cool">★</span>
                                        <span class="etoile<?php print $n ?> cool">★</span>
                                    </form>
                                </article>
                            </div>

                <?php $n++; }
                    }
                } ?>
                <div>

                </div>

        </section>



    </main>
    <script src="ressources/script_etoile.js"></script>
</body>

</html>