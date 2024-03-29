<?php
session_start();


include_once('./config/database.php');

$bdd = new DataBase;

$bdd->getConnexion();

if(isset($_POST['connect_email'], $_POST['connect_password'])){
    if(!empty($_POST['connect_email']) AND !empty($_POST['connect_password'])){
        $message = $bdd->logIn($_POST['connect_email'], $_POST['connect_password']);
    }
}
else{
    $bdd->createTemporaryUser();
}


?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>
            FoodSpot
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
		
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">        <link rel="stylesheet" href="./css/main.css" />
        <link rel="stylesheet" href="./css/navBar.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js' différé asynchrone></script>
 <style>
.btn-outline-dark {
	background: black;
	color: white;
	border-radius: 0;
}
.btn-outline-dark:hover {
	background: white;
	color: black;
}
.btn-outline-light {
	background: black;
	color: white !important;
	border: black;
	border-radius: 0;
}
.btn-outline-light span  {
	color: white !important;
}
.btn-outline-light:hover {
	color: black !important;
}
.btn-outline-light:hover span  {
	color: black !important;
}
.activeLiv {
    background-color: #444b52 !important;
}
</style> 
    </head>

    <body class="bg-light">

        <header>

        </header>
        <div class="bgdd-white border-bottom d-flex justify-content-center" style="background: rgb(223,194,150);"> <!-- 191,161,115 -->
            <?php
                include_once('./composant/NavBar/navBar.php');
            ?>
        </div>
        <div class="w-100 mx-auto" style="max-width: 1024px; align-items: center; background: transparent;">
        <?php  
        include_once('./composant/NavBar/cartModal.php');

        if(isset($_GET['cat'])){
            include('./pages/productByCat.php');
        }
        else if(isset($_GET['page']) AND $_GET['page'] == 1) {
            include('./pages/connect.php');
            include('./pages/acceuil.php');
        }
        else if(isset($_GET['page']) AND $_GET['page'] == 2){
            include('./pages/signIn.php');
            include('./pages/acceuil.php');
        }
        elseif(isset($_GET['page'], $_SESSION['user']) AND $_GET['page'] == 'compte'){
            include('./pages/compte.php');
        }
        else{
            include('./pages/acceuil.php');
        }
        ?>
        
        </div>

        <footer style="background: rgb(223,194,150);">
            <?php
                include('./composant/Footer/footer.php');
            ?>
        </footer>
        <!-- END OF FILE  -->
        
        <!-- BOOTSTRAP -->

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    </body>

</html>