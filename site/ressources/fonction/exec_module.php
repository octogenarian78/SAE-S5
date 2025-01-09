<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log(print_r($_POST, true));
    include "db_connect.php";

    $conn = connectDB();
    $programme = $_POST['programme'];
    $number = $_POST['number'];

    // Préparer une requête pour récupérer le chemin d'accès du programme
    $stmt = $conn->prepare("SELECT chemin_acces FROM Programmes WHERE prog_id = :programme");
    $stmt->bindParam(':programme', $programme, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        $cheminAcces = "../../../" . $result['chemin_acces'];

        // Exécution de la commande Bash
        $output = shell_exec("mpiexec -n 4 python3" . escapeshellcmd($programme1) . " " . escapeshellarg($number) . "2>&1");

        // Retourner la sortie pour affichage ou traitement
        echo json_encode(['success' => true, 'output' => json_decode($output)]);
    } else {
        echo json_encode(['success' => false, 'message' => "Programme introuvable."]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "Requête invalide."]);
}

