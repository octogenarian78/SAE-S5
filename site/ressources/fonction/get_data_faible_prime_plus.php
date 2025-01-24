<?php

function get_data_faible_prime_plus() {
    $handle = fopen('../data/prime_mieux_1200000_Faible.csv', 'r');
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
        if (isset($entry['Time']) && is_numeric($entry['Time'])) {
            $temps[] = (float) $entry['Time'];
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
        if (isset($entry['Argument']) && is_numeric($entry['Argument'])) {
            $points[] = (int) $entry['Argument'];
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

get_data_faible_prime_plus();
