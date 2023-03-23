<?php 
    // contrôle des données avant injection ou après extraction
    require_once ("modele/modele.class.php");

    class Controleur {
        private $unModele ; // instance de la classe Modele

        public function __construct($serveur, $bdd, $user, $mdp){
            // Instanciation de la classe Modele
            $this->unModele = new Modele ($serveur, $bdd, $user, $mdp); 
        }
    /**************************************** LES CLASSES ******************************************/
        public function selectAllClasses ()
        {
            // Récupération des classes 
            $lesClasses = $this->unModele->selectAllClasses();
            // Je réalise des traitements : contrôle des données 

            // Je retourne mes résultats
            return $lesClasses;
        }
        public function insertClasse($tab)
        {
            // Je contrôle les données avant insertion

            // Insertion des données via le modèle
            $this->unModele->insertClasse($tab);
        }
        public function selectLikeClasses($mot)
        {
        $lesClasses = $this->unModele->selectLikeClasses($mot);
        return $lesClasses;
        }
        public function deleteClasse($idclasse)
        {
            $this->unModele->deleteClasse($idclasse);
        }
        public function selectWhereClasse($idclasse)
        {
            return $this->unModele->selectWhereClasse($idclasse);
        }
        public function updateClasse($tab)
        {
            $this->unModele->updateClasse($tab);
        }
    /**************************************** LES ÉTUDIANTS  ******************************************/
        public function selectAllEtudiants ()
        {
        // Récupération des classes 
        $lesEtudiants = $this->unModele->selectAllEtudiants();
        // Je réalise des traitements : contrôle des données 

        // Je retourne mes résultats
        return $lesEtudiants;
        }

        public function selectEtudiantsClasse ($idclasse)
        {
        // Récupération des etudiants 
        $lesEtudiants = $this->unModele->selectEtudiantsClasse($idclasse);
        // Je réalise des traitements : contrôle des données 

        // Je retourne mes résultats
        return $lesEtudiants;
        }
        public function insertEtudiant($tab)
        {
        // Je contrôle les données avant insertion

        // Insertion des données via le modèle
        $this->unModele->insertEtudiant($tab);
        }
        public function selectLikeEtudiants($mot)
        {
            $lesEtudiants = $this->unModele->selectLikeEtudiants($mot);
            return $lesEtudiants;
        }  
        public function deleteEtudiant($idetudiant)
        {
            $this->unModele->deleteEtudiant($idetudiant);
        }        
        public function selectWhereEtudiant($idetudiant)
        {
            return $this->unModele->selectWhereEtudiant($idetudiant);
        }
        public function updateEtudiant($tab)
        {
            $this->unModele->updateEtudiant($tab);
        }
    
    /**************************************** LES PROFESSEURS  ******************************************/
    public function selectAllProfesseurs ()
    {
        // Récupération des classes 
        $lesProfesseurs = $this->unModele->selectAllProfesseurs();
        // Je réalise des traitements : contrôle des données 

        // Je retourne mes résultats
        return $lesProfesseurs;
    }
    public function insertProfesseur($tab)
    {
        // Je contrôle les données avant insertion

        // Insertion des données via le modèle
        $this->unModele->insertProfesseur($tab);
    }
    public function selectLikeProfesseurs($mot)
    {
        $lesProfesseurs = $this->unModele->selectLikeProfesseurs($mot);
        return $lesProfesseurs;
    }
    /**************************************** LES ENSEIGNEMENTS  ******************************************/
    public function selectAllEnseignements ()
    {
        // Récupération des classes 
        $lesEnseignements = $this->unModele->selectAllEnseignements();
        // Je réalise des traitements : contrôle des données 

        // Je retourne mes résultats
        return $lesEnseignements;
    }
    public function insertEnseignement($tab)
        {
            // Je contrôle les données avant insertion

            // Insertion des données via le modèle
            $this->unModele->insertEnseignement($tab);
        }
    public function selectLikeEnseignements($mot)
        {
            $lesEnseignements = $this->unModele->selectLikeEnseignements($mot);
            return $lesEnseignements;
        }

        /*************************************** USER  ***********************************************/
    public function verifConnexion ($email, $mdp)
    {
        return $this->unModele->verifConnexion($email, $mdp);
    }


    /***************************************** AUTRES METHODES ***************************************/
    public function count ($table)
    {
        return $this->unModele->count($table);
    }

    public function selectAllVue ()
    {
        return $this->unModele->selectAllVue();
    }
    }
?>