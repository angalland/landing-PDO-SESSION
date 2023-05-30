<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Admin</title>

            <link rel="stylesheet" href="css/update_style.css" />

            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet" />
        
            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        </head>

        <body>

            <?php

                // si il n'y a pas de session demarrer, demarre une session
                if (session_id() == "")
                session_start();
                // relie admin a db-functions
                require_once('php/db-functions.php');

                if (isset($_SESSION["errors"])){ // Si il y a une $_SESSION['errors] alors
                    foreach($_SESSION["errors"] as $error) {
                        if ($error != false) {
                            echo $alert = "<p class='errors'>" . $error . "</p>";	// envoie le message d'alerte		
                        }
                    unset($_SESSION["errors"]); // supprime le message d'alert a chaque refresh de page
                    }
                };
            ?>
            <div class='alert'>
            <?php    
                // envoie un message lorsque le formulaire a bien été modifier   
                if (isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                };
            ?>
            </div>

            <div class='alert'>
            <?php  
                // envoie un message lorsqu'on supprime un formulaire
                if (isset($_SESSION['delete'])){
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                };
            ?>
            </div> 
            
            <div class='alert'>
                <?php    
                    // envoie un message lorsque le formulaire a bien été créer   
                    if (isset($_SESSION['createMessage'])){
                        echo $_SESSION['createMessage'];
                        unset($_SESSION['createMessage']);
                    };
                ?>
            </div>

            <div>
                <?php
                    if (isset($_SESSION["deleteErrors"])){ // Si il y a une $_SESSION['deleteErrors] alors
                        foreach($_SESSION["deleteErrors"] as $error) {
                            if ($error != false) {
                                echo $alert = "<p class='errors'>" . $error . "</p>";	// envoie le message d'erreure		
                            }
                                unset($_SESSION["deleteErrors"]); // supprime le message d'erreur a chaque refresh de page
                        }
                    };
                ?>
            </div>

            <section class='pricing'>

                <header id="headerPricing">
                    <h2>Update Pricing</h2>
                </header>

                <main class="mainPricing">
                    <?php
                        // récupère les id de la base de donnée avec la fonction pricing()
                        $pricings = pricing();
                        // fait une boucle pour appliqué la fonction formulaire($id) sur toutes les id
                        foreach ($pricings as $pricing){
                            $id = $pricing['id_pricing'];
                            formulaire($id);
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
                    ?>
                    
                </main>
            </section>

            <section class="pricing">

                <header id="headerPricing">
                    <h2>Create Pricing</h2>
                </header>

                <main class="mainCreate">

                    <?php
                        // fonction divCreate() qui crée un formulaire
                        divCreate();

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
                    ?>

                    
                </main>
            </section>
        </body>
    </html>