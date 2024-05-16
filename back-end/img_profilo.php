<?php

    session_start();
    include("../connessione.php");
    $id=$_SESSION['id'];

    $target_dir = "upload/";
    $target_file = $target_dir . $_FILES["imgprofilo"]["name"];
    $target_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if($target_type != "jpg" && $target_type != "jpeg" && $target_type != "png")
    {
        $_SESSION["foto"] = "Errore: sono ammessi solo i formati JPG, JPEG e PNG";
        header("Location: ../front-end/profile.php");
        exit;
    }

    if(move_uploaded_file($_FILES["imgprofilo"]["tmp_name"], $target_file))
    {
        $sql = "UPDATE utente SET foto_profilo = '$target_file' WHERE id = '$id'";
        $result = $conn->query($sql);
        $_SESSION["foto"] = "Il file è stato caricato correttamente";
        header("Location: ../front-end/profile.php");
    }
    else
    {
        $_SESSION["foto"] = "Errore durante il caricamento";
        header("Location: ../front-end/profile.php");
    }
?>