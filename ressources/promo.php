<?php
require_once("./config/db.php");

class Promo extends db
{

    private $code;

    private $remise;

    private $quantite;

    private $commande;

    private $produitsId;

    public function setCode($code){
        $this->code = $code;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setRemise($remise){
        $this->remise = $remise;
    }

    public function getRemise(): int
    {
        return $this->remise;
    }

    public function setQuantite($quantite){
        $this->quantite = $quantite;
    }

    public function getQuantite(): int
    {
        return $this->quantite;
    }


    public function setCommande($commande){
        $this->commande = $commande;
    }

    public function getCommande(): int
    {
        return $this->commande;
    }

    public function setProduitsId($produitsId){
        $this->produitsId = $produitsId;
    }

    public function getProduitsId(): int
    {
        return $this->produitsId;
    }

    public function getAllPromos()
    {
        $sql = "SELECT * FROM reduction";
        $done = $this->connecte()->query($sql);
        return $done->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPromo()
    {
        $code = $this->getCode();
        $reduction = $this->getRemise();
        $quantitee = $this->getQuantite();
        $produit = $this->getProduitsId();

        $sql = $this->connecte()->prepare("INSERT INTO reduction (code, remise, quantite, produits_id) VALUES (:code, :remise, :quantite, :produits_id)");
        $sql->bindParam(":code", $code);
        $sql->bindParam(":remise", $reduction);
        $sql->bindParam(":quantite", $quantitee);
        $sql->bindParam(":produits_id", $produit);
        $sql->execute();
    }

    public function modifPromo($param = [])
    {
       $sql =$this->connecte()->prepare("UPDATE reduction SET code = :code, remise = :remise, quantite = :quantite WHERE id = :id");
       $sql->bindParam(":code", $param["code"]);
       $sql->bindParam(":remise", $param["remise"]);
       $sql->bindParam(":quantite", $param["quantite"]);
       $sql->bindParam(":id", $param["id"]);
       $sql->execute();
    }

    public function deletePromo($id)
    {
            $sql = $this->connecte()->prepare("DELETE FROM reduction WHERE id = :id");
    
            $sql->bindParam(":id", $id);
            $sql->execute();
    }

}