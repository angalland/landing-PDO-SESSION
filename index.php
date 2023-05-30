<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Index</title>

            <link rel="stylesheet" href="css/style.css">
            <!-- <link rel="stylesheet" href="css/update_style.css" /> -->

            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet" />
        
            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        </head>

        <body>

            <!-- On relie index.php aux autre fichier.php -->
            <?php
                // Demarre une session si il n'en a pas déja une
                if (session_id() == "")
                session_start();
                // Fait appelle au fichier db-functions
                require_once('php/db-functions.php');

                if (isset($_SESSION["errorsJoin"])){ // Si il y a une $_SESSION['errorsJoin] alors
                    foreach($_SESSION["errorsJoin"] as $error) {
                        if ($error != false) {
                            echo $alert = "<p class='errors'>" . $error . "</p>";	// envoie le message d'alerte		
                        }
                    unset($_SESSION["errorsJoin"]); // supprime le message d'alert a chaque refresh de page
                    }
                };
                if (isset($_SESSION["errorsEmail"])){ // Si il y a une $_SESSION[email] alors
                    foreach($_SESSION["errorsEmail"] as $error) {
                        if ($error != false) {
                            echo $alert = "<p class='errors'>" . $error . "</p>";	// envoie le message d'alerte		
                        }
                    unset($_SESSION["errorsEmail"]); // supprime le message d'alert a chaque refresh de page
                    }
                };
            ?>
                <div class='alert'>
            <?php    
                // envoie un message lorsque que l'utilisateur adhere a un formulaire   
                if (isset($_SESSION['join'])){
                    echo $_SESSION['join'];
                    unset($_SESSION['join']);
                };
                // envoie un message lorsque l'utilisateur a saisie son email
                if (isset($_SESSION['addEmail'])){
                    echo $_SESSION['addEmail'];
                    unset($_SESSION['addEmail']);
                };
            ?>
            </div>

            <!-- Section pricing -->
            <section class="pricing">

                <!-- HEADER pricing-->
                <header id="headerPricing">
                    <h2 id="h2HeaderPricing">Our Pricing</h2>
                    <p id="pHeaderPricing">It is a long established fact that a reader will be of page when established fact looking at its layout</p>
                </header>
    
                <!-- MAIN pricing-->
                <main class="mainPricing">
                    
                    <!-- Recupere les id dans la base de donnée avec la fonction pricing() puis boucle pour faire la fonction donneePricing() sur toutes les id -->
                    <?php
                    $pricings = pricing();
                    foreach ($pricings as $pricing){
                        $id = $pricing['id_pricing'];
                        donneePricing($id);
                    }

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
                                     
                                     <!-- Envoie l'id et le nom du formulaire dans traitement.php avec le nom submitJoin -->
                                     <form class="formArticlePricing" action="php/traitement.php" method="post">
                                         <input type='hidden' name='id_pricing' value='<?=$id_pricing?>'>
                                         <input type='hidden' name='nom_pricing' value='<?=$nom_pricing?>'>
                                         <input class="buttonArticlePricing" type="submit" name='submitJoin' value='Join'>
                                     </form>
                     
                                     <!-- Envoie l'email dans traitement.php avec le button -->
                                     <form class="formContenair1" action="php/traitement.php" method="post">
                                         <input type="email"  placeholder="Enter your email" name='email'>
                                         <button class="buttonContenair1" type="submit" name='button'>SUBSCRIRE</button>
                                     </form>
                                 </div>              
                             <?php
                     
                         }                       
                     };
                    ?>

                </main>
            </section>           
        </body>
    </html>