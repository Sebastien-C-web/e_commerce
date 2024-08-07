<?php
require_once("./config/db.php");
class Commande extends db
{
    private $num_commande;
    private $produit_id;
    private $date;
    private $total;
    private $user_id;

    public function getNum_commande()
    {
        return $this->num_commande;
    }

    public function setNum_commande($num_commande)
    {
        $this->num_commande = $num_commande;

        return $this;
    }
    public function getProduitId()
    {
        return $this->produit_id;
    }

    public function setProduitId($produit_id)
    {
        $this->produit_id = $produit_id;

        return $this;
    }
    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }
    public function getUser_id()
    {
        return $this->user_id;
    }

    public function setUser_id($user_id)
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function addCommande()
    {
        $num_commande = $this->getNum_commande();
        $date = $this->getDate();
        $user_id = $this->getUser_id();
        $total = $this->getTotal();

        $sql = $this->connecte()->prepare('INSERT INTO commande (numerodecommande, `date`, total, users_id) VALUES (:ndc,  :date, :total, :users_id)');
        $sql->bindParam(':ndc', $num_commande);
        $sql->bindParam(':date', $date);
        $sql->bindParam(':users_id', $user_id);
        $sql->bindParam(':total', $total);
        $sql->execute();
    }

    public function addProduitCommande($param =[])
    {
        $produit_id = $param['prod_id'];
        $ndc = $param['ndc'];
        $qty = $param['qty'];
        $sql = $this->connecte()->prepare('INSERT INTO produits_commande (numerodecommande, produits_id, qty) VALUES (:ndc, :prod_id, :qty)');
        $sql->bindParam(':ndc', $ndc);
        $sql->bindParam(':prod_id', $produit_id);
        $sql->bindParam(':qty', $qty);

        $sql->execute();

    }
}
