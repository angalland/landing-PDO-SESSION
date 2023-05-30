<?php

// Fonction connexion
function connexion(){
    // connexion a la base de donnée
    try { // essaye de se connecter
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

        // On assigne les données récupérées dans des variables
        $id_pricing = $pricing['id_pricing'];
        $nom_pricing = $pricing['nom_pricing'];
        $price = $pricing['price'];
        $sale = $pricing['sale'];
        $bandwitch = $pricing['bandwitch'];
        $online_space = $pricing['online_space'];
        $support = $pricing['support'];
        $domain = $pricing['domain'];
        $hidden_fees = $pricing['hidden_fees'];?>

            <!-- On crée la div qui renvoie les données -->
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
                
                if ($online_space != null){ // si online_space existe
                    if ($online_space >= 1000){ // détermine l'unité de online-space celon ca grandeur
                        $online_space_unit = 'GB'; // >= 1000 -> GB
                        $online_space = $online_space / 1000; // on divise online_space pour le faire concorder a l'unité
                    ?> 
                    <i id="iPricing" class="fa-regular fa-circle-check" style="color: #23b35a;"></i>
                    <p class="pArticlePricing">Onlinespace :</p>
                    <p class="p2ArticlePricing"><?= $online_space;?><?= $online_space_unit;?></p><?php
                    } else {
                        $online_space_unit = 'MB';?> <!-- si online_space <1000 alors unité MB -->
                        <i id="iPricing" class="fa-regular fa-circle-check" style="color: #23b35a;"></i>
                        <p class="pArticlePricing">Onlinespace :</p>
                        <p class="p2ArticlePricing"><?= $online_space;?><?= $online_space_unit;?></p><?php
                    } 
                } else {?> <!-- si online_space est null-->
                    <i id="iPricing" class="fa-regular fa-circle-xmark" style="color: #dd0e23;"></i>
                    <p class="pArticlePricing">Onlinespace :</p>
                    <p class="p2ArticlePricing">No</p><?php
                }
                
                if ($support != null){ //si la donnée support existe
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
                    if ($domain < 5){?> <!-- si elle inférieure a 5 -->
                    <i id="iPricing" class="fa-regular fa-circle-check" style="color: #23b35a;"></i>
                    <p class="pArticlePricing">Domain :</p>
                    <p class="p2ArticlePricing"><?= $domain;?></p><?php
                    } else {?> <!-- si >5 affiche unlimited -->
                        <i id="iPricing" class="fa-regular fa-circle-check" style="color: #23b35a;"></i>
                        <p class="pArticlePricing">Domain :</p>
                        <p class="p2ArticlePricing">Unlimited</p><?php  
                    }
                } else {?> <!-- si elle est null -->
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

                if ($pricing['sale'] != null){?> <!-- si la donnée sale existe alors affiche la div sinon ne l'affiche pas -->                              
                    <div class="divArticlePricing">
                        <p class="pdivArticlePricing"><?= $sale;?>% sale</p>
                    </div><?php
                }?>
                

                <form class="formArticlePricing" action="php/traitement.php" method="post">
                    <input type='hidden' name='id_pricing' value='<?=$id_pricing?>'>
                    <input type='hidden' name='nom_pricing' value='<?=$nom_pricing?>'>
                    <input class="buttonArticlePricing" type="submit" name='submitJoin' value='Join'>
                </form>
                <form class="formContenair1" action="php/traitement.php" method="post">
                    <input type="email"  placeholder="Enter your email" name='email'>
                    <button class="buttonContenair1" type="submit" name='button'>SUBSCRIRE</button>
                </form>
            </div>              
        <?php

    }                       
};

// Ajoute 1 a la colonne count_join de pricing lorsqu'on click sur join
function countJoin($id){
    // se connecte a la base de donnée
    $db = connexion();

    // récupère la valeur de count_join dans la table pricing en fonction de l'id et rajoute 1
    $pricings = pricingById($id);
    foreach ($pricings as $pricing){
    $count = $pricing['count_join'];
    $count++;
    };

    // requete sql
    $sqlQuery = 'UPDATE pricing 
    SET count_join = :count      
    WHERE id_pricing = :id';

    //Transforme la requete sql en un objet pdo pret a etre executer 
    $updateStatment = $db->prepare($sqlQuery);

    // lie les parametre de la requete aux variables id et count 
    $updateStatment->bindParam("id", $id);
    $updateStatment->bindParam("count", $count);

    // execute la requette
    $updateStatment->execute();

}

// modifie les donnée dans la base de donnée avec la variable saisie en paramettre
function update($data){
    // se connecte a la base de donnée
    $db = connexion();

    // requete sql
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

    //Transforme la requete sql en un objet pdo pret a etre executer 
    $updateStatment = $db->prepare($sqlQuery);
   
    // lie les parametre de la requete aux variables du tableaux $data saisie en paramettre de la fonction
    $updateStatment->bindParam("id", $data['id_pricing']);
    $updateStatment->bindParam("nom_pricing", $data['nom_pricing']);
    $updateStatment->bindParam("price", $data['price']);
    $updateStatment->bindParam("sale", $data['sale']);
    $updateStatment->bindParam("bandwitch", $data['bandwitch']);
    $updateStatment->bindParam("online_space", $data['online_space']);
    $updateStatment->bindParam("support", $data['support']);
    $updateStatment->bindParam("domain", $data['domain']);
    $updateStatment->bindParam("hidden_fees", $data['hidden_fees']);

    // execute la requette
    $updateStatment->execute();
};

//crée un formulaire en fonction de l'id dans la base de donnée pour récupéré les données saisie par l'utilisateur, pour soit modifié le formulaire, soit le supprimer.
function formulaire($id){ 
    // récupére les donnée en fonction de l'id
    $pricings = pricingById($id);

    // assigne ces données a des variables
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
    ?>

    <!-- crée le formulaire -->
    <div class="articlePricing">
        <!-- formulaire envoyé a traitement.php par post -->
        <form action='php/traitement.php' method='post'>

            <!-- récupere la valeur de l'id, non visible par l'utilisateur -->
            <input type='hidden' name='id_pricing' value='<?=$idPricing?>'>

            <!-- affiche le nom de la base de donnée et récupere le nom saisie par l'utilisateur -->
            <div>
                <label for='nom_pricing'>Name</label>
                <input type='text' id='nom_pricing' name='nom_pricing' value='<?= $name;?>'>
            </div>
                
            <!-- affiche le prix de la base de donnée et récupere le prix saisie par l'utilisateur -->
            <div>
                <label for='price'>Price</label>
                <input type='number' id='price' name='price' value='<?= $price;?>'>
            </div>

            <!-- affiche le sale de la base de donnée et récupere le sale saisie par l'utilisateur -->
            <div>
                <label for='sale'>Sale</label>
                <input type='number' id='sale' name='sale' min='0' max="100" step="5" value='<?= $sale;?>'>
            </div>

            <!-- affiche bandwitch de la base de donnée et récupere bandwitch saisie par l'utilisateur -->
            <div>
                <label for='bandwitch'>Bandwidth</label>
                <input type='number' id='bandwitch' name='bandwitch' min='0' max='50' value='<?= $bandwitch;?>'>
            </div>

            <!-- affiche online_space de la base de donnée et récupere online_space saisie par l'utilisateur -->
            <div>
                <label for='online_space'>OnlineSpace</label>
                <input  id='online_space' name='online_space' min='0' value='<?= $online_space;?>'>
            </div>

            <!-- affiche support de la base de donnée et récupere support saisie par l'utilisateur sous forme de checkbox qui renvoie 'on' si cocher et null si vide-->
            <div>
                <label for='support'>Support</label>
                <input type='checkbox' name='support' <?php if ($support == 1) echo 'checked';?>>
            </div>

            <!-- affiche domain de la base de donnée et récupere domain saisie par l'utilisateur -->
            <div>
                <label for='domain'>Domain</label>
                <input type='number' id='domain' name='domain' min='0' value='<?php echo $domain;?>'>
            </div>

            <!-- affiche hidden_fees de la base de donnée et récupere hidden_fees saisie par l'utilisateur sous forme de checkbox qui renvoie 'on' si cocher et null si vide-->
            <div>
                <label for='hidden_fees'>Hidden fees</label>
                <input type='checkbox' name='hidden_fees' <?php if ($hidden_fees == 1) echo 'checked';?>>
            </div>
               
            <!-- bouton d'envoie -->
            <div id='divUpdate'>
                <input type='submit' name='submitUpdate' value='update' id='updateForm'>
            </div>
        </form>

        <!-- boutton de suppression du formulaire -->
        <form action='php/traitement.php' method='post'>
            <!-- récupere l'id du formulaire -->
            <input type='hidden' name='id_pricing' value='<?=$idPricing?>'>

            <div id='divUpdate'>
                <input type='submit' name='submitDelete' value='Delete form' id='updateForm'>
            </div>
        </form>           
    </div>
<?php          
} 

// Crée une nouvelle ligne dans la table pricing dans la base de donnée
function create($data){
    // se connecte a la base de donnée
    $db = connexion();

    // requetesql
    $sqlQuery = 'INSERT INTO pricing 
                (nom_pricing, price, sale, bandwitch, online_space, support, domain, hidden_fees)
                VALUES (:nom_pricing,
                        :price,
                        :sale,
                        :bandwitch,
                        :online_space,
                        :support,
                        :domain, 
                        :hidden_fees)';

    //Transforme la requete sql en un objet pdo pret a etre executer    
    $updateStatment = $db->prepare($sqlQuery);

    //lie les parametres sql au valeur des variables du tableaux transmis en paramettre
    $updateStatment->bindParam("nom_pricing", $data['nom_pricing']);
    $updateStatment->bindParam("price", $data['price']);
    $updateStatment->bindParam("sale", $data['sale']);
    $updateStatment->bindParam("bandwitch", $data['bandwitch']);
    $updateStatment->bindParam("online_space", $data['online_space']);
    $updateStatment->bindParam("support", $data['support']);
    $updateStatment->bindParam("domain", $data['domain']);
    $updateStatment->bindParam("hidden_fees", $data['hidden_fees']);

    // execute la requete
    $updateStatment->execute();
}

// Crée un formulaire qui ajoutera une ligne dans la base de donnée via la fonction create()
function divCreate(){
    ?>

    <div class="articlePricing">
        <form action='php/traitement.php' method='post'>

            <input type='hidden' name='id_pricing'>
           
            <div>
            <label for='nom_pricing'>Name</label>
            <input type='text' id='nom_pricing' name='nom_pricing'>
            </div>

            <div>
            <label for='price'>Price</label>
            <input type='number' id='price' name='price'>
            </div>

            <div>
            <label for='sale'>Sale</label>
            <input type='number' id='sale' name='sale' min='0' max="100" step="5">
            </div>

            <div>
            <label for='bandwitch'>Bandwidth</label>
            <input type='number' id='bandwitch' name='bandwitch' min='0' max='50'>
            </div>

            <div>
            <label for='online_space'>OnlineSpace</label>
            <input  id='online_space' name='online_space' min='0'>
            </div>

            <div>
            <label for='support'>Support</label>
            <input type='checkbox' name='support'>
            </div>

            <div>
            <label for='domain'>Domain</label>
            <input type='number' id='domain' name='domain' min='0'>
            </div>

            <div>
            <label for='hidden_fees'>Hidden fees</label>
            <input type='checkbox' name='hidden_fees'>
            </div><?php
           
            ?>
            <div id='divUpdate'>
            <input type='submit' name='submitCreate' value='Create' id='updateForm'>
            </div>
        </form>
    </div>

    <!-- affiche un message de réussite si le formulaire est créer -->
    <div class='alert'><?php       
            if (isset($_SESSION['message'])){
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            };
};

// supprime une ligne dans la base de donnée
function delete($data){

    $db = connexion();

    $sqlQuery = 'DELETE FROM pricing 
                WHERE id_pricing = :id
                ';
                
    $updateStatment = $db->prepare($sqlQuery);
   
    $updateStatment->bindParam("id", $data['id_pricing']);

    $updateStatment->execute();
}

?>
