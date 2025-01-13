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
            // Si le ping réussit, récupère l'utilisation CPU via SSH

            // Commande pour obtenir l'utilisation CPU globale :
            // 1. 'top -bn1' : Exécute une itération de 'top' en mode batch (sans interface interactive).
            // 2. '| awk "/%CPU/ {getline; sum += $9} END {print sum}"' :
            //    - Trouve la ligne avec '%CPU' pour détecter le tableau des processus.
            //    - 'getline' : Passe à la ligne suivante où commencent les données.
            //    - 'sum += $9' : Ajoute les valeurs de la 9ème colonne (%CPU de chaque processus).
            //    - 'END {print sum}' : Affiche la somme totale des utilisations CPU.
            $cpuUsageCommand = "ssh pi@$rpi";
            $cpuUsageOutput = [];
            $output = shell_exec($cpuUsageCommand);

            $data = json_decode($output, true);

            echo "<script>console.log('" . addslashes($data) . "')</script>";

            

            if ($cpuUsageResult === 0 && isset($cpuUsageOutput[0])) {
                $cpuUsage = floatval($cpuUsageOutput[0]);

                // Si l'utilisation CPU dépasse 80%, on considère que le RPI est "en cours d'utilisation"
                if ($cpuUsage > 80) {
                    $statuses[$rpi] = "En cours d'utilisation"; // En jaune
                } else {
                    $statuses[$rpi] = "Connecté"; // En vert
                }
            } else {
                // Si la commande SSH ou la récupération CPU échoue
                $statuses[$rpi] = "Usage incertain"; // En orange
            }
        } else {
            // Si le ping échoue, le RPI est considéré comme déconnecté
            $statuses[$rpi] = "Déconnecté"; // En rouge
        }
    }

    return $statuses;
}
