<?php
// Déclaration du tableau d'articles et le retourne

function getArticles(){
    $articles=
    [
[
    "id"=>1,
    "nom"=>"pc-1",
    "description"=>"
    Les points clés
        Processeur : AMD Ryzen 7 5700G
        Carte graphique : AMD Radeon RX6600 XT
        Mémoire vive : 16 Go
        Stockage : SSD 512 Go
    
    ",
    "description_detaille"=>"
    Performance graphique
        Type de carte graphique : dédiée
        Avantage de la carte graphique dédiée : Une carte graphique dédiée est indispensable pour faire du traitement photo ou vidéo, ainsi que pour jouer à des jeux vidéos exigeants en terme de ressources.
        Modèle : AMD Radeon RX6600 XT
        Type de mémoire : GDDR6
        Compatible réalité virtuelle : Oui
        Mémoire : 8 Go
    Performance
        Processeur : AMD Ryzen 7 5700G
        Fréquence du processeur (en GHz) : 3,8
        Fréquence Turboboost (en GHz) : 4.6
        Le + du Turboboost : donne automatiquement à votre processeur plus de vitesse en cas de besoin
        Nombres de coeurs du processeur : 8
        Intérêt du nombre de coeurs : un nombre de coeur important vous permettra d'effectuer plus de tâches en simultanné
        Mémoire vive : 16 Go
        Format de mémoire vive : DDR4
        Fréquence (en MHz) : 3733
        Nombre de barettes : 2
        Extensible jusqu'à : 16 Go
        Rétro-éclairage du processeur : RGB
        Rétro-éclairage de la mémoire vive (RAM) : RGB
    ",
    "prix"=>1499"€",
    "image"=>"pc-gamer.jpg"
],
[
    "id"=>2,
    "nom"=>"pc-1",
    "description"=>"",
    "description_detaille"=>"",
    "prix"=>,
    "image"=>
],
[
    "id"=>3,
    "nom"=>"pc-1",
    "description"=>"",
    "description_detaille"=>"",
    "prix"=>,
    "image"=>
]
];
    return $articles;
}