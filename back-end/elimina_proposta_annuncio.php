<?php
    session_start();
    if($_SESSION['log'] ==false )
    {
        $_SESSION['status']="Devi effettuare l'accesso prima di poter accedere a questa pagina";
        header("Location: ../index.php");
    }
    else
    {
        include('../connessione.php');
        $id = $_SESSION['id'];
        $id_prp=$_POST['idproposta'];
        $id_ann=$_POST['idAnnuncio'];
        $sql="DELETE FROM Proposta WHERE id='$id_prp'";
        $conn->query($sql);
        
        $sql="SELECT url_foto FROM Foto WHERE idAnnuncio='$id_ann'";
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()) {
            $path = $row['nomeFoto'];
            if(file_exists($path)) {
                unlink($path);
            }
        }
        $sql="DELETE FROM Foto WHERE idAnnuncio='$id_ann'";
        $conn->query($sql);
        $sql="DELETE FROM Annuncio WHERE id='$id_ann'";
        $conn->query($sql);
        
        header("Location: ../front-end/sendeed.php");
    }
?>