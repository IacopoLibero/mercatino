<?php
session_start();
include '../connessione.php';
$idAnnuncio = $_SESSION['idAnnuncio'];
$id = $_SESSION['id'];
$idUtente = (int)$id;
$idA = (int)$idAnnuncio;
echo $idAnnuncio;
echo $id;
var_dump($idUtente);
var_dump($idA);


$sql = "DELETE FROM Annuncio WHERE id = ? AND idUtente = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Errore nella preparazione della query: " . $conn->error);
}

$stmt->bind_param("ii", $idA, $idUtente);

if ($stmt->execute()) {
    $_SESSION['status'] = "Annuncio eliminato con successo";
} else {
    $_SESSION['status'] = "Errore durante l'eliminazione dell'annuncio: " . $stmt->error;
}

$stmt->close();
$conn->close();
header("Location: ../front-end/profile.php");
unset($_SESSION['status']);
exit();
?>
