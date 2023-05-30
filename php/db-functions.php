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
    WHERE id_pricing = :id'; // condition id_pricing = a l'id saisie en argument de la fonction
    $pricingStatment = $db->prepare($sqlQuery);
    $pricingStatment->bindParam("id", $id);
    $pricingStatment->execute();
    $pricings = $pricingStatment->fetchAll();
    return $pricings; // retourne les donnée de l'id saisie en argument de la fonction 
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

// fonction qui ajoute l'email dans la base de donnée
function addEmail($data){
     // se connecte a la base de donnée
     $db = connexion();

     // requete sql
     $sqlQuery = 'INSERT INTO email_table (email)
                  VALUES (
                         :email
                         )';   
                  
 
     //Transforme la requete sql en un objet pdo pret a etre executer 
     $updateStatment = $db->prepare($sqlQuery);
    
     // lie les parametre de la requete aux variables du tableaux $data saisie en paramettre de la fonction
     $updateStatment->bindParam("email", $data['email']);
 
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
