<?php

class panier extends db 
{

    private $produits_id;

    private $total;

    private $reduction_id;

    public $db;



public function __construct()
    {
        $this->db = new db();
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

}