<?php 
    // contrôle des données avant injection ou après extraction
    require_once ("modele/modele.class.php");

    class Controleur {
        private $unModele ; // instance de la classe Modele

        public function __construct($serveur, $bdd, $user, $mdp){
            // Instanciation de la classe Modele
            $this->unModele = new Modele ($serveur, $bdd, $user, $mdp); 
        }

        public function setTable ($uneTable)
        {
            $this->unModele->setTable($uneTable);
        }
   
        public function selectAll ()
        {
            // Récupération des classes 
            $lesResultats = $this->unModele->selectAll();
            // Je réalise des traitements : contrôle des données 

            // Je retourne mes résultats
            return $lesResultats;
        }

        public function insert($tab)
        {
            // Je contrôle les données avant insertion

            // Insertion des données via le modèle
            $this->unModele->insert($tab);
        }

        public function selectLike($mot, $tab)
        {
        $lesResultats = $this->unModele->selectLike($mot, $tab);
        return $lesResultats;
        }

        public function delete($id, $valeur)
        {
            $this->unModele->delete($id, $valeur);

        }

        public function selectWhere($id, $valeur)
        {
            return $this->unModele->selectWhere($id, $valeur);
        }

        public function update($tab, $id, $valeurId)
        {
            $this->unModele->update($tab, $id, $valeurId);
        }
    /**************************************** LES ÉTUDIANTS  ******************************************/

        public function selectEtudiantsClasse ($idclasse)
        {
        // Récupération des etudiants 
        $lesEtudiants = $this->unModele->selectEtudiantsClasse($idclasse);
        // Je réalise des traitements : contrôle des données 

        // Je retourne mes résultats
        return $lesEtudiants;
        }
            
    
    /**************************************** LES PROFESSEURS  ******************************************/

    /**************************************** LES ENSEIGNEMENTS  ******************************************/

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

    }
?>