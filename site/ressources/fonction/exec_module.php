<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log(print_r($_POST, true));
    include "db_connect.php";

    $conn = connectDB();
    $programme = $_POST['programme'];
    $number = $_POST['number'];
    $nbRPI = $_POST['nbRPI'];

    // Préparer une requête pour récupérer le chemin d'accès du programme
    $stmt = $conn->prepare("SELECT chemin_acces FROM Programmes WHERE prog_id = :programme");
    $stmt->bindParam(':programme', $programme, PDO::PARAM_STR);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Le chemin d'accès est bien récupéré
        $cheminAcces = "../../../" . $result['chemin_acces'];

        // Construire la commande avec un espace entre python3 et le chemin du programme
        $command = "mpiexec -n" . escapeshellcmd($nbRPI) . "python3 " . escapeshellcmd($cheminAcces) . " " . escapeshellarg($number) . " 2>&1";

        // Exécuter la commande
        $output = shell_exec($command);     

        // Vérifier si la commande a retourné quelque chose
        if ($output !== null) {
            // Vérifier si la sortie est un JSON valide
            $data = json_decode($output, true);

            if ($data !== null) {
                // Retourner la sortie pour affichage ou traitement
                echo json_encode(['success' => true, 'output' => $data["value"]]);
            } else {
                echo json_encode(['success' => false, 'message' => "Le JSON retourné est invalide. ". $output]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => "Aucune sortie n'a été générée par la commande."]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => "Programme introuvable."]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "Requête invalide."]);
}
