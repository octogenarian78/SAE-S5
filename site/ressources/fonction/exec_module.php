<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log(print_r($_POST, true));
    include "db_connect.php";

    $conn = connectDB();
    $programme = $_POST['programme'] ?? '';
    $number = $_POST['number'] ?? '';
    $nbRPI = $_POST['nbRPI'] ?? '';
    $util_id = $_SESSION['util_id'] ?? '';

    if (empty($programme) || empty($number) || empty($nbRPI)) {
        echo json_encode(['success' => false, 'message' => "Données manquantes ou invalides."]);
        exit;
    }

    try {
        $conn->beginTransaction();

        // Compter le nombre de lignes avant l'insertion
        $countStmt = $conn->prepare("SELECT COUNT(*) FROM Calculs WHERE prog_id = :programme AND util_id = :util_id");
        $countStmt->bindParam(':programme', $programme, PDO::PARAM_INT);
        $countStmt->bindParam(':util_id', $util_id, PDO::PARAM_INT);
        $countStmt->execute();
        $initialCount = $countStmt->fetchColumn();

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
                    $insertStmt = $conn->prepare("INSERT INTO Calculs (util_id, prog_id, entree, sortie, tps_calcul) VALUES (:util_id, :programme, :entree, :sortie, :tps_calcul)");
                    $insertStmt->bindParam(':util_id', $util_id, PDO::PARAM_INT);
                    $insertStmt->bindParam(':programme', $programme, PDO::PARAM_INT);
                    $insertStmt->bindParam(':entree', $number, PDO::PARAM_INT);
                    $insertStmt->bindParam(':sortie', $data["value"], PDO::PARAM_INT);
                    $insertStmt->bindParam(':tps_calcul', $data["temps"], PDO::PARAM_STR);
                    $insertStmt->execute();

                    // Recompter les lignes après l'insertion
                    $countStmt->execute();
                    $finalCount = $countStmt->fetchColumn();

                    if ($finalCount - $initialCount > 1) {
                        $deleteStmt = $conn->prepare("DELETE FROM Calculs WHERE prog_id = :programme AND util_id = :util_id ORDER BY calc_id DESC LIMIT :limit");
                        $deleteStmt->bindParam(':programme', $programme, PDO::PARAM_INT);
                        $deleteStmt->bindParam(':util_id', $util_id, PDO::PARAM_INT);
                        $deleteStmt->bindValue(':limit', $finalCount - $initialCount - 1, PDO::PARAM_INT);
                        $deleteStmt->execute();
                    }

                    $conn->commit();
                    echo json_encode(['success' => true, 'output' => $data]);
                } else {
                    $conn->rollBack();
                    echo json_encode(['success' => false, 'message' => "Le JSON retourné est invalide."]);
                }
            } else {
                $conn->rollBack();
                echo json_encode(['success' => false, 'message' => "Aucune sortie n'a été générée par la commande."]);
            }
        } else {
            $conn->rollBack();
            echo json_encode(['success' => false, 'message' => "Programme introuvable."]);
        }
    } catch (PDOException $e) {
        $conn->rollBack();
        error_log("Database error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => "Erreur de base de données."]);
    } catch (Exception $e) {
        $conn->rollBack();
        error_log("General error: " . $e->getMessage());
        echo json_encode(['success' => false, 'message' => "Erreur inattendue."]);
    }
} else {
    echo json_encode(['success' => false, 'message' => "Requête invalide."]);
}
