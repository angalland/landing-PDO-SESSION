<?php

// Fonction connexion

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
};



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
};


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
};

function update($data){

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
                 WHERE id_pricing = :id';
                
    $updateStatment = $db->prepare($sqlQuery);
   
        $updateStatment->bindParam("id", $data['id_pricing']);
        $updateStatment->bindParam("nom_pricing", $data['nom_pricing']);
        $updateStatment->bindParam("price", $data['price']);
        $updateStatment->bindParam("sale", $data['sale']);
        $updateStatment->bindParam("bandwitch", $data['bandwitch']);
        $updateStatment->bindParam("online_space", $data['online_space']);
        $updateStatment->bindParam("support", $data['support']);
        $updateStatment->bindParam("domain", $data['domain']);
        $updateStatment->bindParam("hidden_fees", $data['hidden_fees']);

        $updateStatment->execute();
    };

    function formulaire($id){ 

        $pricings = pricingById($id);

        foreach ( $pricings as $pricing) {
        $idPricing = $pricing['id_pricing'];
        $name = $pricing['nom_pricing'];
        $price = round($pricing['price'],0);
        $sale = $pricing['sale'];
        $bandwitch = $pricing['bandwitch'];
        $online_space = $pricing['online_space'];
        $support = $pricing['support'];
        $domain = $pricing['domain'];
        $hidden_fees = $pricing['hidden_fees'];
        }
        
        ?><div class="articlePricing">
            <form action='admin.php' method='post'>

                <input type='hidden' name='id_pricing' value='<?=$idPricing?>'>
               
                <div>
                <label for='nom_pricing'>Name</label>
                <input type='text' id='nom_pricing' name='nom_pricing' value='<?= $name;?>'>
                </div>

                <div>
                <label for='price'>Price</label>
                <input type='number' id='price' name='price' value='<?= $price;?>'>
                </div>

                <div>
                <label for='sale'>Sale</label>
                <input type='number' id='sale' name='sale' min='0' max="100" step="5" value='<?= $sale;?>'>
                </div>

                <div>
                <label for='bandwitch'>Bandwidth</label>
                <input type='number' id='bandwitch' name='bandwitch' min='0' max='50' value='<?= $bandwitch;?>'>
                </div>

                <div>
                <label for='online_space'>OnlineSpace</label>
                <input  id='online_space' name='online_space' min='0' value='<?= $online_space;?>'>
                </div>

                <div>
                <label for='support'>Support</label>
                <input type='checkbox' name='support' <?php if ($support == 1) echo 'checked';?>>
                </div>

                <div>
                <label for='domain'>Domain</label>
                <input type='number' id='domain' name='domain' min='0' value='<?php echo $domain;?>'>
                </div>

                <div>
                <label for='hidden_fees'>Hidden fees</label>
                <input type='checkbox' name='hidden_fees' <?php if ($hidden_fees == 1) echo 'checked';?>>
                </div><?php
               
                ?>
                <div id='divUpdate'>
                <input type='submit' name='submit' value='update' id='updateForm'>
                </div>
            </form>
        </div><?php          
        }?> 
<?php

function create($data){

    $db = connexion();

    $sqlQuery = 'INSERT INTO pricing 
                (nom_pricing, price, sale, bandwitch, online_space, support, domain, hidden_fees)
                VALUES (nom_pricing = :nom_pricing,
                        price = :price,
                        sale = :sale,
                        bandwitch = :bandwitch,
                        online_space = :online_space,
                        support = :support,
                        domain = :domain, 
                        hidden_fees = :hidden_fees)';
                
    $updateStatment = $db->prepare($sqlQuery);
   
        $updateStatment->bindParam("nom_pricing", $data['nom_pricing']);
        $updateStatment->bindParam("price", $data['price']);
        $updateStatment->bindParam("sale", $data['sale']);
        $updateStatment->bindParam("bandwitch", $data['bandwitch']);
        $updateStatment->bindParam("online_space", $data['online_space']);
        $updateStatment->bindParam("support", $data['support']);
        $updateStatment->bindParam("domain", $data['domain']);
        $updateStatment->bindParam("hidden_fees", $data['hidden_fees']);

        $updateStatment->execute();
}

?>
