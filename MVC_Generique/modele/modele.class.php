<?php 
// exécuter des requêtes d'extraction et d'injection de données
    class  Modele {
        private $unPDO ; // instance de la classe PDO: PHP Data Object
        private $table ; // table générique du modèle
        public function __construct($serveur, $bdd, $user, $mdp){
            $this->unPDO = null;
            try{
                $url = "mysql:host=".$serveur.";dbname=".$bdd;
                //instanciation de la classe PDO
                $this->unPDO = new PDO($url, $user, $mdp);
            }
            catch(PDOException $exp){
                echo "<br> Erreur de connexion à la BDD !";
                echo $exp->getMessage();
            }
        }
        public function setTable ($uneTable)
        {
            $this->table = $uneTable;
        }
        public function selectAll ()
        {
            if ($this->unPDO != null){
                $requete ="select * from ".$this->table.";";
                // préparation de la requête
                $select = $this->unPDO->prepare($requete);
                // exécution de la requête 
                $select->execute();
                // extraction des données  
                $lesResultats = $select->fetchAll();
                return $lesResultats;
            } else {
                return null;
            }
        }
        public function insert($tab)
        {
            if($this->unPDO != null) {
                $tabChamps = array();
                $donnees = array();
                foreach ($tab as $cle => $valeur) {
                    $tabChamps[] = ":".$cle;
                    $donnees[":".$cle] = $valeur;
                }
                $chaineChamps = implode(",", $tabChamps);

                $requete = "insert into ".$this->table." values (null, ".$chaineChamps.");";
                //echo $requete;
                //var_dump($donnees);
                $insert = $this->unPDO->prepare($requete);
                $insert->execute($donnees);
            }
        }
        public function selectLike ($mot, $tab)
        {
            if ($this->unPDO != null){
                $tabChamps = array();
                foreach ($tab as $cle) {
                    $tabChamps [] = $cle. " like :mot";
                }
                $chaineChamps = implode( " or ", $tabChamps);
                $requete ="select * from ".$this->table." where ".$chaineChamps." ;";
                $donnees = array (":mot"=>"%".$mot."%");

                // préparation de la requête
                $select = $this->unPDO->prepare($requete);
                // exécution de la requête 
                $select->execute($donnees);
                // extraction des données classes 
                $lesResultats = $select->fetchAll();
                return $lesResultats;
            } else {
                return null;
            }
        }
        public function delete ($id, $valeur)
        {
            if ($this->unPDO != null){
                $requete ="delete from ".$this->table." where ".$id." =:".$id.";";
                $donnees = array (":".$id=>$valeur);
                $delete = $this->unPDO->prepare($requete);
                $delete->execute($donnees);
            }
        }
        public function selectWhere ($id, $valeur)
        {
            if ($this->unPDO != null){
                $requete ="select * from ".$this->table." where ".$id." =:".$id.";";
                $donnees = array (":".$id=>$valeur);
                $select = $this->unPDO->prepare($requete);
                $select->execute($donnees);
                $unResultat = $select->fetch(); // un seul résultat
                return $unResultat;
            }
        }
        public function update($tab, $id, $valeurId)
        {
            if($this->unPDO != null) {
                $tabChamps = array();
                $donnees = array();
                foreach ($tab as $cle=>$valeur) {
                    $tabChamps[] = $cle." =:".$cle;
                    $donnees[":".$cle] = $valeur;
                }
                $chaineChamps = implode(" , ", $tabChamps);
                $requete = "update ".$this->table." set ".$chaineChamps." where ".$id." =:".$id.";";

                $donnees  [":".$id] = $valeurId;
                $update = $this->unPDO->prepare($requete);
                $update->execute($donnees);
            }
        }

        public function count ($table)
        {
            if($this->unPDO != null) {
                $requete ="select count(*) as nb from ".$table;
                $select = $this->unPDO->prepare($requete);
                $select->execute();
                $unResultat = $select->fetch();
                return $unResultat;
            } else {
                return null;
            }
        }
        /*************************************** LES ÉTUDIANTS  **********************************/

        public function selectEtudiantsClasse ($idclasse)
        {
            if ($this->unPDO != null){
                $requete ="select * from etudiant where idclasse =:idclasse ;";
                $donnees = array (":idclasse"=>$idclasse);
                // préparation de la requête
                $select = $this->unPDO->prepare($requete);
                // exécution de la requête 
                $select->execute ($donnees);
                // extraction des données classes 
                $lesEtudiants = $select->fetchAll();
                return $lesEtudiants;
            } else {
                return null;
            }
        }

        /************************************************ USER  ******************************************************/
        public function verifConnexion ($email, $mdp)
        {
            if($this->unPDO != null){
                $requete ="select * from user where email =:email and mdp = :mdp ;";
                $donnees = array(":email"=>$email, ":mdp"=>$mdp);
                $select = $this->unPDO->prepare($requete);
                $select->execute($donnees);
                $unUser = $select->fetch();
                return $unUser;
            } else {
                return null;
            }
        }


        public function verifConnexion1 ($email, $mdp)
        {
            if($this->unPDO != null){
                $requete ="select * from user where email ='".$email."' and mdp = '".$mdp."' ;";
                $select = $this->unPDO->prepare($requete);
                $select->execute();
                $unUser = $select->fetch();
                return $unUser;
            } else {
                return null;
            }
        }


        public function verifConnexion2 ($email, $mdp)
        {
            if($this->unPDO != null){
                $requete ="select * from user where email =? and mdp =? ;"
                ;
                $select = $this->unPDO->prepare($requete);
                $select->BindValue(1, $email, PDO::PARAM_STR);
                $select->BindValue(2, $mdp, PDO::PARAM_STR);
                $select->execute();
                $unUser = $select->fetch();
                return $unUser;
            } else {
                return null;
            }
        }


        public function verifConnexion3 ($email, $mdp)
        {
            if($this->unPDO != null){
                $requete ="select * from user where email =:email and mdp =:mdp ;"
                ;
                $select = $this->unPDO->prepare($requete);
                $select->BindValue(":email", $email, PDO::PARAM_STR);
                $select->BindValue(":mdp", $mdp, PDO::PARAM_STR);
                $select->execute();
                $unUser = $select->fetch();
                return $unUser;
            } else {
                return null;
            }
        }
    }


    
?>