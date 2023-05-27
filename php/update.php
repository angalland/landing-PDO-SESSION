<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Update pricing</title>

    <link rel="stylesheet" href="../css/update_style.css" />

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
    require_once "db-functions.php";
	if (isset($_SESSION["errors"])){
	foreach($_SESSION["errors"] as $error) {
		if ($error != false) {
			echo $alert = "<p style=\"margin:5px;padding:20px;color:#FF3333;background:#F8D7DA;border-left:solid #FF5555\">" . $error . "</p>";
			unset($alert);
		}
	}}
    ?>

    <section id="pricing">

        <header id="headerPricing">
            <h2>Update Pricing</h2>
        </header>

        <main class="mainPricing"><?php
        
        $pricings = pricing();
            foreach ($pricings as $pricing){
                $id = $pricing['id_pricing'];
                 formulaire($id);
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
            <div class='alert'>
                <p><?php 
                if (isset($_SESSION['alert'])){
                    echo $_SESSION['alert'];  
                    unset($_SESSION['alert']);   
                };?></p>
            </div>           
        </main>
    </section>
</body>
</html>

<form action='update.php?action=<?= $idPricing ?>' method='post'>