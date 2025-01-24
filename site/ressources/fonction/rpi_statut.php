<?php
function getRpiStatus() {
    $rpiAliases = ["p1", "p2", "p3", "p4"];
    $rpiIP = [
        "172.19.181.1",
        "172.19.181.2",
        "172.19.181.3",
        "172.19.181.4"
    ];
    $statuses = [];

    for ($i = 0 ; $i < count($rpiAliases) ; $i++) {
        // Vérifie si le RPI est joignable via ping
        $rpi = $rpiAliases[$i];
        $pingOutput = [];
        exec("ping -c 1 -W 1 $rpiIP[$i] 2>&1", $pingOutput, $pingResult);

        if ($pingResult === 0) {
            $statuses[$rpi] = "Connecté"; // En vert
        } else {
            // Si le ping échoue, le RPI est considéré comme déconnecté
            $statuses[$rpi] = "Déconnecté"; // En rouge
        }
    }

    return $statuses;
}
