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
                if (isset($_SESSION["email"])){ // Si il y a une $_SESSION[email] alors
                    foreach($_SESSION["email"] as $error) {
                        if ($error != false) {
                            echo $alert = "<p class='errors'>" . $error . "</p>";	// envoie le message d'alerte		
                        }
                    unset($_SESSION["email"]); // supprime le message d'alert a chaque refresh de page
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
                    ?>

                </main>
            </section>           
        </body>
    </html>