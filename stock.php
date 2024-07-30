<?php

// if($_SESSION["user"]["statut"] == null){
//     header("Location: index.php");
// }
$produits = [["id" => 0, "name" => "veste orange stylée", "description" => "Mon cul commode, mes couilles mickey", "prix" => 175]];
$produitsQuants = [["id" => 0, "produits_id" => 0, "quantites" => 27000]];


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <header>

    </header>
    <main>
        <section class="bg-[#EDAC70] flex flex-col justify-center items-center gap-5">
            <h1>STOCK :</h1>
            <table class="">
                    <thead>
                        <tr class="">
                            <th class="px-5 py-2 border-2 border-black bg-blue-100">Id produit</th>
                            <th class=" px-5 py-2 border-2 border-black bg-blue-100">Nom</th>
                            <th class=" px-5 py-2 border-2 border-black bg-blue-100">Description</th>
                            <th class=" px-5 py-2 border-2 border-black bg-blue-100">Prix</th>
                            <th class=" px-5 py-2 border-2 border-black bg-blue-100">Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($produits as $produit){ ?>
                        <tr>
                            <th class="px-5 py-2 border-2 border-black bg-blue-100"><?php echo $produit["id"]; ?></th>
                            <th class="px-5 py-2 border-2 border-black bg-blue-100"><?php echo $produit["name"]; ?></th>
                            <th class="px-5 py-2 border-2 border-black bg-blue-100"><?php echo $produit["description"]; ?></th>
                            <th class="px-5 py-2 border-2 border-black bg-blue-100"><?php echo $produit["prix"]; ?></th>
                            <th class="px-5 py-2 border-2 border-black bg-blue-100"><?php foreach($produitsQuants as $produitsQuant) { if($produitsQuant["produits_id"] == $produit["id"]) {
                                echo $produitsQuant["quantites"]; }}
                             ?></th>
                        </tr>
                        <?php } ?>
                    </tbody>

        </section>
        <section>

        </section>
    </main>
    <footer>

    </footer>
</body>
</html>