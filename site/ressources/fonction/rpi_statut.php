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

    for ($i = 0; $i < count($rpiAliases); $i++) {
        $rpi = $rpiAliases[$i];

        // 🔹 Debug : Afficher l'IP pingé
        error_log("Pinging $rpi ($rpiIP[$i])...");

        // Vérifie si le RPI est joignable via ping
        $pingOutput = [];
        exec("sudo -u pi ping -c 1 -W 1 {$rpiIP[$i]} 2>&1", $pingOutput, $pingResult);

        if ($pingResult === 0) {
            error_log("$rpi ($rpiIP[$i]) répond au ping !");

            // 🔹 Debug : Afficher la commande SSH exécutée
            $cpuUsageCommand = "sudo -u pi ssh pi@{$rpi} \"top -bn1 | awk '/%Cpu/ {print \\$2 + \\$4}'\"";
            error_log("Exécution de : $cpuUsageCommand");

            $cpuUsageOutput = [];
            exec($cpuUsageCommand . " 2>&1", $cpuUsageOutput, $cpuUsageResult);

            // 🔹 Debug : Résultat de SSH
            error_log("SSH retour code : $cpuUsageResult");
            error_log("SSH sortie : " . implode("\n", $cpuUsageOutput));

            if ($cpuUsageResult === 0 && isset($cpuUsageOutput[0])) {
                $cpuUsage = floatval($cpuUsageOutput[0]);
                error_log("CPU Usage détecté : $cpuUsage%");

                // Si l'utilisation CPU dépasse 80%, on considère que le RPI est "en cours d'utilisation"
                $statuses[$rpi] = ($cpuUsage > 80) ? "En cours d'utilisation" : "Connecté";
            } else {
                // SSH ou récupération CPU échoue
                error_log("Échec récupération CPU, statut incertain.");
                $statuses[$rpi] = "Usage incertain";
            }
        } else {
            // Si le ping échoue, le RPI est considéré comme déconnecté
            error_log("$rpi ($rpiIP[$i]) est déconnecté !");
            $statuses[$rpi] = "Déconnecté";
        }
    }

    return $statuses;
}

