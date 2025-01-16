<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log(print_r($_POST, true));
    include "db_connect.php";

    $conn = connectDB();
    $programme = $_POST['programme'] ?? '';
    $number = $_POST['number'] ?? '';
    $nbRPI = $_POST['nbRPI'] ?? '';

    if (empty($programme) || empty($number) || empty($nbRPI)) {
        echo json_encode(['success' => false, 'message' => "Données manquantes ou invalides."]);
        exit;
    }

    try {
        $stmt = $conn->prepare("SELECT chemin_acces FROM Programmes WHERE prog_id = :programme");
        $stmt->bindParam(':programme', $programme, PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $cheminAcces = "../../../" . $result['chemin_acces'];
            $command = "mpiexec -n " . escapeshellarg($nbRPI) . " python3 " . escapeshellcmd($cheminAcces) . " " . escapeshellarg($number) . " 2>&1";

            error_log("Executing command: $command");
            $output = shell_exec($command);

            if ($output !== null) {
                error_log("Command output: $output");
                $data = json_decode($output, true);

                if (is_array($data) && isset($data["value"], $data["temps"])) {
                    $stmt = $conn->prepare("INSERT INTO Calculs (prog_id, entree, sortie, tps_calcul) VALUES (:programme, :entree, :sortie, :tps_calcul)");
                    $stmt->bindParam(':programme', $programme, PDO::PARAM_STR);
                    $stmt->bindParam(':entree', $number, PDO::PARAM_INT);
                    $stmt->bindParam(':sortie', $data["value"], PDO::PARAM_INT);
                    $stmt->bindParam(':tps_calcul', $data["temps"], PDO::PARAM_INT);
                    $stmt->execute();

                    echo json_encode(['success' => true, 'output' => $data["value"]]);
                } else {
                    echo json_encode(['success' => false, 'message' => "Le JSON retourné est invalide."]);
                }
            } else {
                echo json_encode(['success' => false, 'message' => "Aucune sortie n'a été générée par la commande."]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => "Programme introuvable."]);
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => "Erreur de base de données."]);
    } catch (Exception $e) {
        error_log("General error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => "Erreur inattendue."]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "Requête invalide."]);
}
