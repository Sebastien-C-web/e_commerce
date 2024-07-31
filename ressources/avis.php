<?php
require_once('./config/db.php');
 class Avis extends db {

        private $note;

        private $contenu;

        private $produit_id;

        private $users_id;

        public function setNote($note)
        {
            $this->note = $note;
        }

        public function getNote()
        {
            return $this->note;
        }

        public function setContenu($contenu)
        {
            $this->contenu = $contenu;
        }

        public function getContenu()
        {
            return $this->contenu;
        }

        public function setProduitId($produit_id)
        {
            $this->produit_id = $produit_id;
        }

        public function getProduitId()
        {
            return $this->produit_id;
        }
        public function setUsersId($users_id)
        {
            $this->users_id = $users_id;
        }
        public function getUsersId()
        {
            return $this->users_id;
        }

        public function addAvis()
        {
            $note = $this->getNote();
            $contenu = $this->getContenu();
            $produit_id = $this->getProduitId();
            $users_id = $this->getUsersId();
            $sql = $this->connecte()->prepare('INSERT INTO avis (note, produit_id, contenu, users_id) VALUES (:note, :produit_id, :contenu, :users_id)');
            $sql->bindParam(':note', $note);
            $sql->bindParam(':produit_id', $produit_id);
            $sql->bindParam(':contenu', $contenu);
            $sql->bindParam(':users_id', $users_id);
            $sql->execute();

        }    

        public function addAvisUsers($param = [])
        {
            $users_id = $param['users_id'];
            $produit_id = $param['produit_id'];
            $vote = true;
            $sql = $this->connecte()->prepare('INSERT INTO avis_users (users_id, produit_id, vote) VALUES (:users_id, :produit_id, :vote)');
            $sql->bindParam(':users_id', $users_id);
            $sql->bindParam(':produit_id', $produit_id);
            $sql->bindParam(':vote', $vote);
            $sql->execute();
        }
        public function getAllAvisUsers()
        {
            $sql = 'SELECT * FROM avis_users';
            $done = $this->connecte()->query($sql);
            return $done->fetchAll(PDO::FETCH_ASSOC);
        }

 }