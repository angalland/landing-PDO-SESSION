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
                ?>

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
                    ?>
                    
                    <?php
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
                            // envoie un message lorsqu'on supprime un formulaire
                            if (isset($_SESSION['delete'])){
                                echo $_SESSION['delete'];
                                unset($_SESSION['delete']);
                            };
                        ?>
                    </div>   
                </main>
            </section>

            <section class="pricing">

                <header id="headerPricing">
                    <h2>Create Pricing</h2>
                </header>

                <main class="mainUpdate">

                    <?php
                        // fonction divCreate() qui crée un formulaire
                        divCreate();
                    ?>

                    <div class='alert'>
                        <?php    
                            // envoie un message lorsque le formulaire a bien été créer   
                            if (isset($_SESSION['message'])){
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
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
                </main>
            </section>
        </body>
    </html>