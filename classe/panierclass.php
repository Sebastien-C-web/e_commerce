<?php
require_once("./config/db.php");
class panier extends db 
{

    private $produits_id;

    private $total;

    private $reduction_id;

    public $db;

    private $panier;



public function __construct()
    {
        $this->db = $this->connecte();
    }

public function setProduitsid($produits_id)

{

$this->produits_id=$produits_id;

}

public function getProduitsid()

{

return $this->produits_id;

}

public function setTotal($total)

{

$this->total=$total;

}

public function getTotal()

{

    return $this->total;

}

public function setReductionid($reduction_id)

{

    $this->reduction_id=$reduction_id;

}

public function getReductionid()

{

    return $this->reduction_id;

}


public function getArticle($id){
    $sql = $this->db->prepare("SELECT * FROM produits WHERE id = :id");
    $sql->bindParam(":id", $id);
    $sql->execute();
    return $sql->fetch(PDO::FETCH_ASSOC);
}




// Ajout panier db 

public function getAllpanier()
{

 
    $produits_id = $panier->getArticle();
    $total = $panier->getTotal();
    $reduction_id = $panier->getReductionid();

    $sql = $this->db->prepare("INSERT INTO panier (produits_id, total, reduction_id) VALUES (:produits_id, :total, :reduction_id)");
    $sql->bindParam(':produit', $produits_id);
    $sql->bindParam(':total', $total);
    $sql->bindParam(':reductin_id', $reduction_id);
    $sql->execute();
    $this->db->commit();

}
    


}