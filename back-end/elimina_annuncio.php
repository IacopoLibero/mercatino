<?php
    include ('../connessione.php');
    session_start();
    if($_SESSION['log'] ==false )
    {
        $_SESSION['status']="Devi effettuare l'accesso prima di poter accedere a questa pagina";
        header("Location: ../index.php");
    }
    $id=$_POST['idAnnuncio'];

    $sql="SELECT url_foto FROM Foto WHERE idAnnuncio='$id'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $path = $row['nomeFoto'];
            if(file_exists($path)) {
                unlink($path);
            }
        }

    $sql="DELETE FROM Foto WHERE idAnnuncio='$id'";
    $conn->query($sql);
    
    $sql = "DELETE FROM Annuncio WHERE id =$id ";
    $conn->query($sql);
    header("Location: ../front-end/profile.php");
?>
