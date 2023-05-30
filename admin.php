<!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title>Admin</title>

            <link rel="stylesheet" href="css/style.css">
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
                if (session_id() == "")
                session_start();
                require_once('php/db-functions.php');
                ?>

            <section class='pricing'>

                <header id="headerPricing">
                    <h2>Update Pricing</h2>
                </header>

                <main class="mainPricing">
                    <?php
                        $pricings = pricing();
                        foreach ($pricings as $pricing){
                            $id = $pricing['id_pricing'];
                            formulaire($id);
                        }; 
                    ?>

                    <div class='alert'>
                        <?php       
                            if (isset($_SESSION['message'])){
                                echo $_SESSION['message'];
                                unset($_SESSION['message']);
                            };
                        ?>
                    </div>
                    
                    <?php
                        if (isset($_SESSION["errors"])){
                            foreach($_SESSION["errors"] as $error) {
                                if ($error != false) {
                                    echo $alert = "<p class='errors'>" . $error . "</p>";			
                                }
                            unset($_SESSION["errors"]);
                            }
                        };
                    ?>

                    <div class='alert'>
                        <?php       
                            if (isset($_SESSION['delete'])){
                                echo $_SESSION['delete'];
                                unset($_SESSION['delete']);
                            };
                        ?>
                    </div>   
                </main>
            </section>
        </body>
    </html>