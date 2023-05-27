<?php

if (session_id() == "")
  session_start();
require_once('db-functions.php');

if(isset($_POST['submit'])){

    $datas = [];
    $_SESSION["errors"] = [];

    $_SESSION["errors"][] = ($datas['id_pricing'] = filter_input(INPUT_POST, "id_pricing", FILTER_VALIDATE_INT)) ? false : "Id_pricing non reconnue";
    $_SESSION["errors"][] = ($datas['nom_pricing'] = filter_input(INPUT_POST, "nom_pricing", FILTER_SANITIZE_STRING)) ? false : "nom_pricing non reconnue";
    $_SESSION["errors"][] = ($datas['price'] = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT)) ? false : "price non reconnue";
    $_SESSION["errors"][] = ($datas['sale'] = filter_input(INPUT_POST, "sale", FILTER_VALIDATE_INT)) ? false : "sale non reconnue";
    $_SESSION["errors"][] = ($datas['bandwitch'] = filter_input(INPUT_POST, "bandwitch", FILTER_VALIDATE_INT)) ? false : "bandwitch non reconnue";
    $_SESSION["errors"][] = ($datas['online_space'] = filter_input(INPUT_POST, "online_space", FILTER_VALIDATE_INT)) ? false : "online_space non reconnue";
    $_SESSION["errors"][] = ($datas['support'] = filter_input(INPUT_POST, "support", FILTER_VALIDATE_BOOL)) ? false : "support non reconnue";
    $_SESSION["errors"][] = ($datas['domain'] = filter_input(INPUT_POST, "domain", FILTER_VALIDATE_INT)) ? false : "domain non reconnue";
    $_SESSION["errors"][] = ($datas['hidden_fees'] = filter_input(INPUT_POST, "hidden_fees", FILTER_VALIDATE_BOOL)) ? false : "hidden_fees";

    if (!empty($_SESSION["errors"])){
        header("Location:update.php");
    }

    update($datas);
      
}

header("Location:update.php");
?>