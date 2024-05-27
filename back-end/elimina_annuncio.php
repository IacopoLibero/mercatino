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

$sql = "DELETE FROM Annuncio WHERE id = $idA AND idUtente = $idUtente";

if ($conn->query($sql) === TRUE) {
    $_SESSION['elimina'] = "Eliminazione andata a buon fine";
} else {
    $_SESSION['elimina'] = "Errore durante l'eliminazione dell'annuncio: " . $conn->error;
}

$conn->close();
header("Location: ../front-end/profile.php");

exit();
?>
