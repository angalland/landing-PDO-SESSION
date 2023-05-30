CREATE TABLE IF NOT EXISTS pricing (    -- crée la table pricing
    id_pricing int(11) NOT NULL AUTO_INCREMENT, -- id de pricing int, obligatoire, ajoute 1 automatiquement à la création
    nom_pricing varchar(25) NOT NULL, -- nom de pricing, string 25 caract max, obligatoire
    price decimal(5,2) NOT NULL,   -- prix nombre décimal(5chiffre max et 2 chiffre max apres la ,), obligatoire
    sale int, -- vente, entier, non obligatoire
    bandwitch int, -- bande passante,  int, non obligatoire
    online_space int, -- espace en ligne, string 25caract max, non obligatoire
    support tinyint(1), -- soutien, booleen, non obligatoire
    domain int, -- nombre de domaine, int, non obligatoire
    hidden_fees tinyint(1), -- frais caché, boolen, non obligatoire
    PRIMARY KEY (id_pricing) -- affecte la clef primaire a id_pricing
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin; -- utilise le moteur innodb

INSERT INTO pricing (nom_pricing, price, sale, bandwitch, online_space, support, domain, hidden_fees) -- insere des données dans le tableau
VALUES 
    ('Starter', 9, null, 1, '500MB', 0, 1, 0),
    ('Advanced', 19, 20, 2, '1GB', 1, 3, 0),
    ('Professional', 29, null, 3, '2GB', 1, 'Unlimited', 0);

ALTER TABLE pricing -- crée une nouvelle colonne count_join dans la table pricing
ADD count_join;