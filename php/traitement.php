<?php

// si il n'y a pas de session ouverte en demarre une
if (session_id() == "")
  session_start();
// lie le fichier db-functions a traitement.php
require_once('db-functions.php');

// si submitUpdate a été enclenché
if(isset($_POST['submitUpdate'])){

    // récupere les données de $_post dans $datas sous forme de tableaux
    $datas = [];
    // crée une $_SESSION['errors']
    $_SESSION["errors"] = [];

    // filtre les données pour id, nom et price, si filter_input renvoie false alors crée une entré dans $_SESSION['errors]
    ($datas['id_pricing'] = filter_input(INPUT_POST, "id_pricing", FILTER_VALIDATE_INT)) ? false : $_SESSION['errors'][]='Id_pricing non reconnue';    
    ($datas['nom_pricing'] = filter_input(INPUT_POST, "nom_pricing", FILTER_SANITIZE_STRING)) ? false : $_SESSION["errors"][] = "le nom est incorrecte, veuillez-saisir un nom sans caractère spéciaux";
    ($datas['price'] = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT)) ? false : $_SESSION["errors"][] = "Price est obligatoire, veuillez saisir un prix qui soit un entier positif";

    // filtre les données pour sale, bandwitch, online_space, domain; avec une option minimum dans filter_imput; si filtre false alors $datas['donnee'] == null
    ($datas['sale'] = filter_input(INPUT_POST, "sale", FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min)))) ? false : $datas['sale'] = null;
    ($datas['bandwitch'] = filter_input(INPUT_POST, "bandwitch", FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min)))) ? false : $datas['bandwitch'] = null;
    ($datas['online_space'] = filter_input(INPUT_POST, "online_space", FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min)))) ? false : $datas['online_space'] = null;
    ($datas['domain'] = filter_input(INPUT_POST, "domain", FILTER_VALIDATE_INT,  array("options" => array("min_range"=>$min)))) ? false : $datas['domain'] = null;

    // récupère les donnée des checkbox si cheked alors $datas = 1 sinon = 0;
    $datas['support'] = isset($_POST['support']) ? 1 : 0;
    $datas['hidden_fees'] = isset($_POST['hidden_fees']) ? 1 : 0;

    // si il y a $_SESSION['errors] alors renvoie sur admin.php
    if (!empty($_SESSION['errors'])){
        header("Location:../admin.php");
    } else { // sinon fait la fonction update avec comme argument le tableau $datas
      update($datas);
    // envoie un message de confirmation
    $_SESSION['message'] = 'Votre formulaire '.$datas['nom_pricing'].' a bien été modifié !';
    // renvoie a admin.php 
    header("Location:../admin.php");
    }
}

// si submitDelete est enclenché
if(isset($_POST['submitDelete'])){

  // récupère les données dans $datas sous forme de tableau
  $datas = [];

  // crée $_SESSION['errors]
  $_SESSION["errors"] = [];

  // filtre l'id si false crée une entré dans le tableau $_SESSION
  $_SESSION["errors"][] = ($datas['id_pricing'] = filter_input(INPUT_POST, "id_pricing", FILTER_VALIDATE_INT)) ? false : "Id_pricing non reconnue";

  // si il a une valeur dans le tableau $_SESSION['errors'] 
  if (!empty($_SESSION["errors"])){
    header("Location:../admin.php"); // renvoie vers admin
  } // sinon
  // appelle la fonction delete avec comme argument $datas
  delete($datas);
  // envoie un message de confirmation
  $_SESSION['delete'] = 'Votre formulaire a bien été supprimé !';
  // renvoie vers admin
  header("Location:../admin.php");
}

// si sumitCreate a été enclenché
if(isset($_POST['submitCreate'])){

  $datas = [];
  $_SESSION["deleteErrors"] = [];
      
  ($datas['nom_pricing'] = filter_input(INPUT_POST, "nom_pricing", FILTER_SANITIZE_STRING)) ? false : $_SESSION["deleteErrors"][] = "Vous devez saisir un nom obligatoire sans caractère spéciaux";
  ($datas['price'] = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT)) ? false : $_SESSION["deleteErrors"][] = "Vous devez saisir un prix obligatoire, il doit être un entier positif";

  ($datas['sale'] = filter_input(INPUT_POST, "sale", FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min)))) ? false : $datas['sale'] = null;
  ($datas['bandwitch'] = filter_input(INPUT_POST, "bandwitch", FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min)))) ? false : $datas['bandwitch'] = null;
  ($datas['online_space'] = filter_input(INPUT_POST, "online_space", FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min)))) ? false : $datas['online_space'] = null;
  ($datas['domain'] = filter_input(INPUT_POST, "domain", FILTER_VALIDATE_INT,  array("options" => array("min_range"=>$min)))) ? false : $datas['domain'] = null;

  $datas['support'] = isset($_POST['support']) ? 1 : 0;
  $datas['hidden_fees'] = isset($_POST['hidden_fees']) ? 1 : 0;

  if (!empty($_SESSION["deleteErrors"])){
    header("Location:../admin.php");
  }
  // fait appelle a la fonction create avec en argument le tableau $datas
  create($datas);

  $_SESSION['createMessage'] = 'Votre formulaire '.$datas['nom_pricing'].' a bien été crée !';

  header("Location:../admin.php");

}

// si submitJoin a été enclenché
if(isset($_POST['submitJoin'])){

  // récupere les données de $_post dans $datas sous forme de tableaux
  $datas = [];
  // crée une $_SESSION['errors']
  $_SESSION["errorsJoin"] = [];

  // filtre les données pour id, nom_pricing si filter_input renvoie false alors crée une entré dans $_SESSION['errors]
  ($datas['id_pricing'] = filter_input(INPUT_POST, "id_pricing", FILTER_VALIDATE_INT)) ? false : $_SESSION['errorsJoin'][]='Id_pricing non reconnue';
  ($datas['nom_pricing'] = filter_input(INPUT_POST, "nom_pricing", FILTER_SANITIZE_STRING)) ? false : $_SESSION['errorsJoin'][]='nom_pricing non reconnue';

 
  if (!empty($_SESSION['errorsJoin'])){  // si $_SESSION['errorsJoin'] est non null alors
    header("Location:../index.php");
  } else { // sinon fait la fonction 
    countJoin($datas['id_pricing']);
    // envoie un message de confirmation
    $_SESSION['join'] = 'Vous avez bien adhérer à '.$datas['nom_pricing'].' !';
    // renvoie a admin.php 
    header("Location:../index.php");
  }
}

if(isset($_POST['button'])){
  $datas = [];
  $_SESSION['errorsEmail'] = [];

  ($datas['email'] = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)) ? false : $_SESSION["errorsEmail"][] = "Votre email est incorrecte, vous devez saisir un email de type nom.prenom@hotline.com";

  if (!empty($_SESSION['email'])){  // si $_SESSION['email'] est non null alors
    header("Location:../index.php");
  } else { // sinon fait la fonction 
    
    // envoie un message de confirmation
    $_SESSION['addEmail'] = 'Votre email a bien été enregistré !';
    // renvoie a admin.php 
    header("Location:../index.php");
  }
}

?>