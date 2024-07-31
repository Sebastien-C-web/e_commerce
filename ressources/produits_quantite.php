<?php 
require_once('./config/db.php');

class ProduitsQuantites extends db {

    private $id;
    
    private $quantite;

    public function setId($id){
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setQuantite($quantite){
        $this->quantite = $quantite;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }

    public function getAllQuantite()
    {
        $sql = "SELECT * FROM produits_quantite";
        $done = $this->connecte()->query($sql);
        return $done->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addQuantite()
    {
        $id = $this->getId();
        $quantite = $this->getQuantite();

        $sql = $this->connecte()->prepare("INSERT INTO produits_quantite (produits_id, quantites) VALUES (:id, :quantites)");
        $sql->bindParam(":id", $id);
        $sql->bindParam(":quantites", $quantite);
        $sql->execute();
    }
}