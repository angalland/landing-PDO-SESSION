<?php

if (session_id() == "")
  session_start();
require_once('db-functions.php');

if(isset($_POST['submitUpdate'])){
    // var_dump($_POST);
    // exit();
    $datas = [];
    $_SESSION["errors"] = [];

    ($datas['id_pricing'] = filter_input(INPUT_POST, "id_pricing", FILTER_VALIDATE_INT)) ? false : $_SESSION['errors'][]='Id_pricing non reconnue';    
    ($datas['nom_pricing'] = filter_input(INPUT_POST, "nom_pricing", FILTER_SANITIZE_STRING)) ? false : $_SESSION["errors"][] = "le nom est incorrecte, veuillez-saisir un nom sans caractère spéciaux";
    ($datas['price'] = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT)) ? false : $_SESSION["errors"][] = "Price est obligatoire, veuillez saisir un prix qui soit un entier positif";

    ($datas['sale'] = filter_input(INPUT_POST, "sale", FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min)))) ? false : $datas['sale'] = null;
    ($datas['bandwitch'] = filter_input(INPUT_POST, "bandwitch", FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min)))) ? false : $datas['bandwitch'] = null;
    ($datas['online_space'] = filter_input(INPUT_POST, "online_space", FILTER_VALIDATE_INT, array("options" => array("min_range"=>$min)))) ? false : $datas['online_space'] = null;
    ($datas['domain'] = filter_input(INPUT_POST, "domain", FILTER_VALIDATE_INT,  array("options" => array("min_range"=>$min)))) ? false : $datas['domain'] = null;

    $datas['support'] = isset($_POST['support']) ? 1 : 0;
    $datas['hidden_fees'] = isset($_POST['hidden_fees']) ? 1 : 0;
    
    if (!empty($_SESSION['errors'])){
        header("Location:../admin.php");
    } else {
      update($datas);

    $_SESSION['message'] = 'Votre formulaire '.$datas['nom_pricing'].' a bien été modifié !';
      
    header("Location:../admin.php");
    }
}

if(isset($_POST['submitDelete'])){

  $datas = [];
  $_SESSION["errors"] = [];

  $_SESSION["errors"][] = ($datas['id_pricing'] = filter_input(INPUT_POST, "id_pricing", FILTER_VALIDATE_INT)) ? false : "Id_pricing non reconnue";

  if (!empty($_SESSION["errors"])){
    header("Location:../admin.php");
  }

  delete($datas);

  $_SESSION['delete'] = 'Votre formulaire a bien été supprimé !';

  header("Location:../admin.php");
}

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

  create($datas);

  $_SESSION['message'] = 'Votre formulaire '.$datas['nom_pricing'].' a bien été crée !';

  header("Location:../admin.php");

}
?>