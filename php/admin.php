<?php

if (session_id() == "")
  session_start();
require_once('db-functions.php');

if(isset($_POST['submit'])){

    $datas = [];
    $errors = [];

    $datas["id_pricing"] = filter_input(INPUT_POST, "id_pricing", FILTER_VALIDATE_INT);
    $name = filter_input(INPUT_POST, "nom_pricing", FILTER_SANITIZE_STRING);
    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT);
    $sale = filter_input(INPUT_POST, "sale", FILTER_VALIDATE_INT);
    $bandwitch = filter_input(INPUT_POST, "bandwitch", FILTER_VALIDATE_INT);
    $online_space = filter_input(INPUT_POST, "online_space", FILTER_VALIDATE_INT );
    $support = filter_input(INPUT_POST, "support",FILTER_SANITIZE_STRING);
    $domain = filter_input(INPUT_POST, "domain", FILTER_VALIDATE_INT);
    $hidden_fees = filter_input(INPUT_POST, "hidden_fees",FILTER_SANITIZE_STRING );


    $errors[] = ($datas['id_pricing'] = filter_input(INPUT_POST, "id_pricing", FILTER_VALIDATE_INT)) ? false : "Id_pricing non reconnue";
    $errors[] = ($datas['nom_pricing'] = filter_input(INPUT_POST, "nom_pricing", FILTER_VALIDATE_INT)) ? false : "nom_pricing non reconnue";
    $errors[] = ($datas['price'] = filter_input(INPUT_POST, "price", FILTER_VALIDATE_INT)) ? false : "price non reconnue";
    $errors[] = ($datas['sale'] = filter_input(INPUT_POST, "sale", FILTER_VALIDATE_INT)) ? false : "sale non reconnue";
    $errors[] = ($datas['bandwitch'] = filter_input(INPUT_POST, "bandwitch", FILTER_VALIDATE_INT)) ? false : "bandwitch non reconnue";
    $errors[] = ($datas['online_space'] = filter_input(INPUT_POST, "online_space", FILTER_VALIDATE_INT)) ? false : "online_space non reconnue";
    $errors[] = ($datas['support'] = filter_input(INPUT_POST, "id_pricing", FILTER_VALIDATE_INT)) ? false : "support non reconnue";
    $errors[] = ($datas['domain'] = filter_input(INPUT_POST, "id_pricing", FILTER_VALIDATE_INT)) ? false : "domain non reconnue";
    $errors[] = ($datas['hidden_fees'] = filter_input(INPUT_POST, "id_pricing", FILTER_VALIDATE_INT)) ? false : "hidden_fees";
   
    
 
    // if ($id && $name && $price && $sale && $bandwitch && $online_space && $domain ){
        
    //     if ($price >= 0 && $sale >= 0 && $bandwitch >= 0 && $domain >= 0 && $online_space >= 0){
            
    //     $data = [
    //         'id_pricing' => $id,
    //         'nom_pricing' => $name,
    //         'price' => $price,
    //         'sale' => $sale,
    //         'bandwitch' => $bandwitch,
    //         'online_space' => $online_space,
    //         'support' => $support,
    //         'domain' => $domain,
    //         'hidden_fees' => $hidden_fees,
    //     ];

    //     $_SESSION['alert'] = 'Votre formulaire '.$data['nom_pricing'].' a bien été modifié';
        
    //     $_SESSION['datas'][] = $data;
        
        
    // } elseif ($price < 0){           
    //     $_SESSION['alert'] = 'Votre formulaire n\'a pas été modifié, votre Price doit être un nombre entier positif';
        
    // } elseif ($sale < 0){
    //         $_SESSION['alert'] = 'Votre formulaire n\'a pas été modifié, votre Sale doit être un entier positif';
            
    //     } elseif ($bandwitch < 0){
    //         $_SESSION['alert'] = 'Votre formulaire n\'a pas été modifié, votre Bandwitch doit être un entier positif';
    //     } elseif ($domain < 0){
    //         $_SESSION['alert'] = 'Votre formulaire n\'a pas été modifié, votre domain doit être un entier positif';
    //     } elseif ($online_space < 0){
    //         $_SESSION['alert'] = 'Votre formulaire n\'a pas été modifié, votre Online_space doit être un entier positif';
    //     }
        
    // } else {
    //     $_SESSION['alert'] = 'Votre formulaire n\'a pas été modifié, il est incorrect !';
    // }
}
// var_dump($SESSION['start']);
header("Location:update.php");
?>