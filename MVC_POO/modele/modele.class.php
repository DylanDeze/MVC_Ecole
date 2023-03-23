<?php 
// exécuter des requêtes d'extraction et d'injection de données
    class  Modele {
        private $unPDO ; // instance de la classe PDO: PHP Data Object
        
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
        /************************************ LES CLASSES  ***********************************/
        public function selectAllClasses ()
        {
            if ($this->unPDO != null){
                $requete ="select * from classe;";
                // préparation de la requête
                $select = $this->unPDO->prepare($requete);
                // exécution de la requête 
                $select->execute();
                // extraction des données classes 
                $lesClasses = $select->fetchAll();
                return $lesClasses;
            } else {
                return null;
            }
        }
        public function insertClasse($tab)
        {
            if($this->unPDO != null) {
                $requete = "insert into classe values (null, :nom, :salle, :diplome);";
                $donnees = array(":nom"=>$tab['nom'],
                                 ":salle"=>$tab['salle'],
                                 ":diplome"=>$tab['diplome']);
                $insert = $this->unPDO->prepare($requete);
                $insert->execute($donnees);
            }
        }
        public function selectLikeClasses ($mot)
        {
            if ($this->unPDO != null){
                $requete ="select * from classe where nom like :mot or salle like :mot or diplome like :mot;";
                $donnees = array (":mot"=>"%".$mot."%");

                // préparation de la requête
                $select = $this->unPDO->prepare($requete);
                // exécution de la requête 
                $select->execute($donnees);
                // extraction des données classes 
                $lesClasses = $select->fetchAll();
                return $lesClasses;
            } else {
                return null;
            }
        }
        public function deleteClasse ($idclasse)
        {
            if ($this->unPDO != null){
                $requete ="delete from classe where idclasse = :idclasse;";
                $donnees = array (":idclasse"=>$idclasse);
                $delete = $this->unPDO->prepare($requete);
                $delete->execute($donnees);
            }
        }
        public function selectWhereClasse ($idclasse)
        {
            if ($this->unPDO != null){
                $requete ="select * from classe where idclasse = :idclasse;";
                $donnees = array (":idclasse"=>$idclasse);
                $select = $this->unPDO->prepare($requete);
                $select->execute($donnees);
                $uneClasse = $select->fetch(); // un seul résultat
                return $uneClasse;
            }
        }
        public function updateClasse($tab)
        {
            if($this->unPDO != null) {
                $requete = "update classe set nom= :nom, salle = :salle, diplome = :diplome where idclasse = :idclasse;";

                $donnees = array(":nom"=>$tab['nom'],
                                 ":salle"=>$tab['salle'],
                                 ":diplome"=>$tab['diplome'],
                                 ":idclasse"=>$tab['idclasse']);
                $update = $this->unPDO->prepare($requete);
                $update->execute($donnees);
            }
        }
        /*************************************** LES ÉTUDIANTS  **********************************/
        public function selectAllEtudiants ()
        {
            if ($this->unPDO != null){
                $requete ="select * from etudiant;";
                // préparation de la requête
                $select = $this->unPDO->prepare($requete);
                // exécution de la requête 
                $select->execute();
                // extraction des données classes 
                $lesEtudiants = $select->fetchAll();
                return $lesEtudiants;
            } else {
                return null;
            }
        }

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

        public function insertEtudiant($tab)
        {
            if($this->unPDO != null) {
                $requete = "insert into etudiant values (null, :nom, :prenom, :email, :idclasse);";
                $donnees = array(":nom"=>$tab['nom'],
                                 ":prenom"=>$tab['prenom'],
                                 ":email"=>$tab['email'],
                                 ":idclasse"=>$tab['idclasse']);
                $insert = $this->unPDO->prepare($requete);
                $insert->execute($donnees);
            }
        }
        public function selectLikeEtudiants ($mot)
        {
            if ($this->unPDO != null){
                $requete ="select * from etudiant where nom like :mot or prenom like :mot or email like :mot;";
                $donnees = array (":mot"=>"%".$mot."%");

                // préparation de la requête
                $select = $this->unPDO->prepare($requete);
                // exécution de la requête 
                $select->execute($donnees);
                // extraction des données classes 
                $lesEtudiants = $select->fetchAll();
                return $lesEtudiants;
            } else {
                return null;
            }
        }
        public function deleteEtudiant ($idetudiant)
        {
            if ($this->unPDO != null){
                $requete ="delete from etudiant where idetudiant = :idetudiant;";
                $donnees = array (":idetudiant"=>$idetudiant);
                $delete = $this->unPDO->prepare($requete);
                $delete->execute($donnees);
            }
        }
        public function selectWhereEtudiant ($idetudiant)
        {
            if ($this->unPDO != null){
                $requete ="select * from etudiant where idetudiant = :idetudiant;";
                $donnees = array (":idetudiant"=>$idetudiant);
                $select = $this->unPDO->prepare($requete);
                $select->execute($donnees);
                $unEtudiant = $select->fetch(); // un seul résultat
                return $unEtudiant;
            }
        }
        public function updateEtudiant($tab)
        {
            if($this->unPDO != null) {
                $requete = "update etudiant set nom= :nom, prenom = :prenom, email = :email, idclasse = :idclasse where idetudiant = :idetudiant;";

                $donnees = array(":nom"=>$tab['nom'],
                                 ":prenom"=>$tab['prenom'],
                                 ":email"=>$tab['email'],
                                 ":idclasse"=>$tab['idclasse']);
                $update = $this->unPDO->prepare($requete);
                $update->execute($donnees);
            }
        }
        
        /***************************************** LES PROFESSEURS  **********************************/
        public function selectAllProfesseurs ()
        {
            if ($this->unPDO != null){
                $requete ="select * from professeur;";
                // préparation de la requête
                $select = $this->unPDO->prepare($requete);
                // exécution de la requête 
                $select->execute();
                // extraction des données classes 
                $lesProfesseurs = $select->fetchAll();
                return $lesProfesseurs;
            } else {
                return null;
            }
        }
        public function insertProfesseur($tab)
        {
            if($this->unPDO != null) {
                $requete = "insert into professeur values (null, :nom, :prenom, :diplome);";
                $donnees = array(":nom"=>$tab['nom'],
                                 ":prenom"=>$tab['prenom'],
                                 ":diplome"=>$tab['diplome']);
                $insert = $this->unPDO->prepare($requete);
                $insert->execute($donnees);
            }
        }
        public function selectLikeProfesseurs ($mot)
        {
            if ($this->unPDO != null){
                $requete ="select * from professeur where nom like :mot or prenom like :mot or diplome like :mot;";
                $donnees = array (":mot"=>"%".$mot."%");

                // préparation de la requête
                $select = $this->unPDO->prepare($requete);
                // exécution de la requête 
                $select->execute($donnees);
                // extraction des données classes 
                $lesProfesseurs = $select->fetchAll();
                return $lesProfesseurs;
            } else {
                return null;
            }
        }
        /***************************************** LES ENSEIGNEMENTS  **********************************/
        public function selectAllEnseignements ()
        {
            if ($this->unPDO != null){
                $requete ="select * from enseignement;";
                // préparation de la requête
                $select = $this->unPDO->prepare($requete);
                // exécution de la requête 
                $select->execute();
                // extraction des données classes 
                $lesEnseignements = $select->fetchAll();
                return $lesEnseignements;
            } else {
                return null;
            }
        }
        public function insertEnseignement($tab)
        {
            if($this->unPDO != null) {
                $requete = "insert into enseignement values (null, :matiere, :nbheures, :coef, :idclasse, :idprofesseur);";
                $donnees = array(":matiere"=>$tab['matiere'],
                                 ":nbheures"=>$tab['nbheures'],
                                 ":coef"=>$tab['coef'],
                                 ":idclasse"=>$tab['idclasse'],
                                 ":idprofesseur"=>$tab['idprofesseur']);
                $insert = $this->unPDO->prepare($requete);
                $insert->execute($donnees);
            }
        }
        public function selectLikeEnseignements ($mot)
        {
            if ($this->unPDO != null){
                $requete ="select * from enseignement where matiere like :mot or nbheures like :mot or coef like :mot or idclasse like :mot or idprofesseur like :mot;";
                $donnees = array (":mot"=>"%".$mot."%");

                // préparation de la requête
                $select = $this->unPDO->prepare($requete);
                // exécution de la requête 
                $select->execute($donnees);
                // extraction des données classes 
                $lesEnseignements = $select->fetchAll();
                return $lesEnseignements;
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

        /************************************************ AUTRES METHODES  ******************************************/
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

        /************** */
        public function selectAllVue ()
        {
            if ($this->unPDO != null){
                $requete ="select * from classesEtudiants;";
                // préparation de la requête
                $select = $this->unPDO->prepare($requete);
                // exécution de la requête 
                $select->execute();
                // extraction des données classes 
                $lesResultats = $select->fetchAll();
                return $lesResultats;
            } else {
                return null;
            }
        }
    }
?>