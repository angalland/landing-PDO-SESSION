<?php

// Fonction connexion
session_start();
function connexion(){
// connexion a la base de donnée
try {
    $db = new PDO (
        'mysql:host=localhost;dbname=landing_pdo',
        'root',
        ''
    );
} catch (Execption $e) { // sinon renvoie cette erreure
    die('Erreur :'. $e->getMessage());
}
return $db;
};

// récupere toutes les données de la base de donnée
function pricing(){
    // On utilise la fonction connexion pour se connecter a la base de donné
    $db = connexion();    
    //requete sql, execution puis récupération des donnée sous forme de tableaux
    $sqlQuery = 
    'SELECT *
    FROM pricing';
    $pricingStatment = $db->prepare($sqlQuery);
    $pricingStatment->execute();
    $pricings = $pricingStatment->fetchAll();
    return $pricings; // retourne le tableau
}



// recupere les donnée de la base de donnée en fonction de id saisie
function pricingById($id){
    // On utilise la fonction connexion pour se connecter a la base de donné
    $db = connexion();    
    //requete sql, execution puis récupération des donnée sous forme de tableaux
    $sqlQuery = 
    'SELECT *
    FROM pricing
    WHERE id_pricing = '.$id; // condition id_pricing = a l'id saisie en argument de la fonction
    $pricingStatment = $db->prepare($sqlQuery);
    $pricingStatment->execute();
    $pricings = $pricingStatment->fetchAll();
    return $pricings; // retourne les donnée de l'id saisie en argument de la fonction 
}


// retourne une div qui affiche les données de l'id saisie en fonction
function donneePricing($id){

   $pricings = pricingById($id); // fait appelle a la fonction idPricing avec $id donnée en argument de la fonction et la stocke dans $pricings
     
    foreach ($pricings as $pricing){ // On fait une boucle pour lire la variable pricings car la fonction pricing nous renvoie un tableau
        $nom_pricing = $pricing['nom_pricing'];
        $price = $pricing['price'];
        $sale = $pricing['sale'];
        $bandwitch = $pricing['bandwitch'];
        $online_space = $pricing['online_space'];
        $support = $pricing['support'];
        $domain = $pricing['domain'];
        $hidden_fees = $pricing['hidden_fees'];?>  

            <div class="articlePricing">
                <h4 class="h4Pricing">
                    <?= $nom_pricing ?> <!-- on affiche le nom pricing -->                         
                </h4> 
                <p class="pPricing"><span class="spanPricing">$</span><strong class="strongArticle"><?=
                     round($price, 0);?></strong>/month</p><?php // on affiche le prix pricing avec la fonction round qui arrondit a 0 chiffres apres la virgule
                
                if ($bandwitch != null){?> <!-- si la donnée bandwitch existe-->
                    <i id="iPricing" class="fa-regular fa-circle-check" style="color: #23b35a;"></i>
                    <p class="pArticlePricing">Bandwidht :</p>
                    <p class="p2ArticlePricing"><?=
                     $bandwitch;?>GB</p><?php // On affiche la donnée bandwitch
                } else {?> <!-- sinon -->
                    <i id="iPricing" class="fa-regular fa-circle-xmark" style="color: #dd0e23;"></i>
                    <p class="pArticlePricing">bandwitch :</p>
                    <p class="p2ArticlePricing">No</p><?php
                }
                
                if ($online_space != null){
                    if ($online_space >= 1000){
                        $online_space_unit = 'GB';
                        $online_space = $online_space / 1000;
                    ?> 
                    <i id="iPricing" class="fa-regular fa-circle-check" style="color: #23b35a;"></i>
                    <p class="pArticlePricing">Onlinespace :</p>
                    <p class="p2ArticlePricing"><?= $online_space;?><?= $online_space_unit;?></p><?php
                    } else {
                        $online_space_unit = 'MB';?>
                        <i id="iPricing" class="fa-regular fa-circle-check" style="color: #23b35a;"></i>
                        <p class="pArticlePricing">Onlinespace :</p>
                        <p class="p2ArticlePricing"><?= $online_space;?><?= $online_space_unit;?></p><?php
                    } 
                } else {?> <!-- sinon -->
                    <i id="iPricing" class="fa-regular fa-circle-xmark" style="color: #dd0e23;"></i>
                    <p class="pArticlePricing">Onlinespace :</p>
                    <p class="p2ArticlePricing">No</p><?php
                }
                
                if ($support != null){ //si la donnée online space existe
                    if($pricing['support'] == 1){?> <!-- la donnée est vrai -->
                        <i id="iPricing" class="fa-regular fa-circle-check" style="color: #23b35a;"></i>
                        <p class="pArticlePricing">Support : </p>
                        <p class="p2ArticlePricing">Yes</p><?php
                    }
                } else {?> <!-- si elle n'existe pas ou est fausse alors -->
                    <i id="iPricing" class="fa-regular fa-circle-xmark" style="color: #dd0e23;"></i>
                    <p class="pArticlePricing">Support :</p>
                    <p class="p2ArticlePricing">No</p><?php
                }

                if ($domain != null){ //<!-- si la donnée domain existe -->
                    if ($domain < 5){?>
                    <i id="iPricing" class="fa-regular fa-circle-check" style="color: #23b35a;"></i>
                    <p class="pArticlePricing">Domain :</p>
                    <p class="p2ArticlePricing"><?= $domain;?></p><?php
                    } else {?>
                        <i id="iPricing" class="fa-regular fa-circle-check" style="color: #23b35a;"></i>
                        <p class="pArticlePricing">Domain :</p>
                        <p class="p2ArticlePricing">Unlimited</p><?php  
                    }
                } else {?> <!-- sinon -->
                    <i id="iPricing" class="fa-regular fa-circle-xmark" style="color: #dd0e23;"></i>
                    <p class="pArticlePricing">Domain :</p>
                    <p class="p2ArticlePricing">No</p><?php
                }
                
                if ($hidden_fees != null){ // si la donnée hidden_fees existe
                    if ($pricing['hidden_fees'] == 1){?> <!-- la donnée est vrai -->
                        <i id="iPricing" class="fa-regular fa-circle-check" style="color: #23b35a;"></i>
                        <p class="pArticlePricing">Hidden Fees :</p>
                        <p class="p2ArticlePricing">Yes</p><?php
                    }
                } else {?> <!-- si la donnée n'existe pas ou est fausse -->
                    <i id="iPricing" class="fa-regular fa-circle-xmark" style="color: #dd0e23;"></i>
                    <p class="pArticlePricing">Hidden fees :</p>
                    <p class="p2ArticlePricing">No</p><?php
                }

                if ($pricing['sale'] != null){?> <!-- si la donnée sale existe alors affiche la cette div sinon ne l'affiche pas -->                              
                    <div class="divArticlePricing">
                        <p class="pdivArticlePricing"><?= $sale;?>% sale</p>
                    </div><?php
                }?>
                
                <form class="formArticlePricing" action="" method="post">
                    <button class="buttonArticlePricing" type="submit">Join Now</button>
                </form>
            </div>              
        <?php

    }                       
}

function update(){
    $db = connexion();

    $sqlQuery = 'UPDATE pricing 
                 SET
                    nom_pricing = :nom_pricing,
                    price = :price,
                    sale = :sale,
                    bandwitch = :bandwitch,
                    online_space = :online_space,
                    support = :support,
                    domain = :domain, 
                    hidden_fees = :hidden_fees
                 WHERE id_pricing = :id
                ';

    $updateStatment = $db->prepare($sqlQuery);

    foreach ($_SESSION['datas'] as $data) {

        $idUpdate = $data['id_pricing'];
        $nom_pricing = $data['nom_pricing'];
        $price = $data['price'];
        $sale = $data['sale'];
        $bandwitch = $data['bandwitch'];
        $online_space = $data['online_space'];
        $support = $data['support'];
        $domain = $data['domain'];
        $hidden_fees = $data['hidden_fees'];

        $updateStatment->execute([
            'id' => $idUpdate,
            'nom_pricing' => $nom_pricing,
            'price' => $price,
            'sale' => $sale,
            'bandwitch' => $bandwitch,
            'online_space' => $online_space,
            'support' => $support,
            'domain' => $domain,
            'hidden_fees' => $hidden_fees,
            
        ]);
    }
}
    
    ?>
