<?php

class DataBase{

    private $host = "localhost";
    private $dbName = "foodspot";
    private $char = "utf8";
    private $user = "root";
    private $password = "";
    public $connexion;

    public function getConnexion(){

        $this->connexion = null;

        try {
            $this->connexion = new PDO('mysql:host='.$this->host.';dbname='.$this->dbName.';charset='.$this->char, $this->user, $this->password);
        }

        catch(PDOException $fail) {
            echo 'Erreur de connexion -> ', $fail->getMessage();
            die();
        }
    }

    public function getCategoriesName() {
        $queryStr = 'SELECT * FROM categories';
        $query = $this->connexion->query($queryStr);
        $respond = $query->fetchAll();
        return $respond;
    }

    public function logIn($mail, $mdp){
        if(isset($mail, $mdp)){
            if(!empty($mail) AND !empty($mdp)){
                $initQuery = $this->connexion->prepare('SELECT * FROM users WHERE mail_users = :mail');
                $initQuery->bindParam(':mail', $mail, PDO::PARAM_STR);
                $initQuery->execute();

                if($initQuery != false){
                    $bddUserInfo = $initQuery->fetch();
                    if($bddUserInfo['mdp_users'] === $mdp){
                        $_SESSION['user'] = $bddUserInfo;
                        $return = '<span class="text-success text-center">Connexion reussie</span>';
                        return $return;
                    }
                    else{
                        $return = '<span class="text-danger text-center">Votre identifiant et votre mot de passe ne correspondent pas.</span>';
                        return $return;
                    }
                }
                else{
                    $return = '<span class="text-danger text-center">Votre identifiant est inconnu.</span>';
                    return $return;
                }
                
            }
        }
    }

    public function getCart($user){
        $queryStr = 'SELECT * FROM cart WHERE id_users = '.$user['id_users'];
        $query = $this->connexion->query($queryStr);
        if($query != false AND !empty($query)){
            $respond = $query->fetchAll();
        }
        else{
            $respond = 'Votre panier est vide';
        }

        return $respond;
    }

    public function getProductNameById($id) {
        $queryStr = 'SELECT nom_produits FROM produits WHERE id_produits = '.$id.'';
        $query = $this->connexion->query($queryStr);
        $respond = $query->fetch();
        return $respond;
    }

    public function getProductById($id) {
        $queryStr = 'SELECT * FROM produits WHERE id_produits = '.$id.'';
        $query = $this->connexion->query($queryStr);
        $respond = $query->fetch();
        return $respond;
    }

    public function getIngredientList($numList) {

        $ingredientIdArray = explode(';', $numList);
        $returnArray = [];

        foreach($ingredientIdArray as $ingredientId){
            $ingredientQuery = $this->connexion->query('SELECT * FROM ingredients WHERE id_ingredients = '.$ingredientId.'');
            $ingredientDetail = $ingredientQuery->fetch();
            array_push($returnArray, $ingredientDetail);
        }

        return $returnArray;
    }

}

?>