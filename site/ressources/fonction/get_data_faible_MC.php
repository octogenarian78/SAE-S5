<?php

function get_data_faible_MC() {
    $handle = fopen('../data/Monte_Carlo_12000000_Faible.csv', 'r');
    $header = fgetcsv($handle);
    $scala = [];
    
    // Lecture du fichier et stockage des données
    while (($row = fgetcsv($handle)) !== FALSE) {
        $scala[] = array_combine($header, $row);
    }
    fclose($handle);

    // Récupération des valeurs de la colonne "Temps"
    $temps = [];
    foreach ($scala as $entry) {
        if (isset($entry['Temps']) && is_numeric($entry['Temps'])) {
            $temps[] = (float) $entry['Temps'];
        }
    }

    // Calcul des moyennes pour les groupes de 50 temps
    $totalTemps = count($temps);
    $groupSize = 50;
    $numGroups = floor($totalTemps / $groupSize);  // Nombre de groupes de 50 temps
    
    $moyennes = [];
    for ($i = 0; $i < $numGroups; $i++) {
        $start = $i * $groupSize;
        $groupTemps = array_slice($temps, $start, $groupSize);
        $moyenne = array_sum($groupTemps) / count($groupTemps);
        $moyennes[] = $moyenne;
    }

    // Calcul du speedup
    $speedup = [];
    if (!empty($moyennes)) {
        $referenceTime = $moyennes[0]; // Utiliser la première moyenne comme référence
        foreach ($moyennes as $moyenne) {
            $speedup[] = round($referenceTime / $moyenne, 2);

        }
    }

    // Récupération des valeurs distinctes de la colonne "Points"
    $points = [];
    foreach ($scala as $entry) {
        if (isset($entry['Points']) && is_numeric($entry['Points'])) {
            $points[] = (int) $entry['Points'];
        }
    }

    // Récupérer les valeurs uniques
    $distinctPoints = array_unique($points);
    sort($distinctPoints); // Tri des points distincts pour l'affichage

    $data = [
        "xAxis" => [
            "type" => "category",
            "data" => $distinctPoints
        ],
        "series" => [
            [
                "name" => "Speedup",
                "type" => "line",
                "data" => $speedup
            ]
        ]
    ];

    // Retourner le JSON
    header('Content-Type: application/json');
    echo json_encode(['data' => $data]);
}

get_data_faible_MC();
