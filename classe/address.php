<?php
require_once("./config/db.php");

class Adresse extends db {

    private $adresse_1;

private $adresse_suite;

private $codepostal;

private $ville;



public function getAdresse_1()
{
return $this->adresse_1;
}

public function setAdresse_1($adresse_1)
{
$this->adresse_1= $adresse_1;

return $this;
}

public function getAdresse_suite()
{
return $this->adresse_suite;
}


public function setAdresse_suite($adresse_suite)
{
$this->adresse_suite = $adresse_suite;

return $this;
}


public function getCodepostale()
{
return $this->codepostal;
}


public function setCodepostal($codepostal)
{
$this->codepostal = $codepostal;

return $this;
}

public function getVille()
{
return $this->ville;
}


public function setVille($ville)
{
$this->ville = $ville;

return $this;
}

public function getAllAdresse()
{
    $sql = "SELECT * FROM adresse";
    $done = $this->connecte()->query($sql);
    return $done->fetchAll(PDO::FETCH_ASSOC);
}
public function addAdresse()
{
    $adresse_1 = $this->getAdresse_1();
    $adresse_suite = $this->getAdresse_suite();
    $codepostal = $this->getCodepostale();
    $ville = $this->getVille();

    $sql = $this->connecte()->prepare("INSERT INTO adresse (adresse_1,adresse_suite,codepostal,ville) VALUES (:adresse_1,:adresse_suite,:codepostal,:ville ) ");
    $sql->bindParam(":adresse_1", $adresse_1);
    $sql->bindParam(":adresse_suite", $adresse_suite);
    $sql->bindParam(":codepostal", $codepostal);
    $sql->bindParam(":ville", $ville);
    $sql->execute();
}

    }
       


