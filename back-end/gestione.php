<?php

    session_start();
    include("conn.php");

    $target_dir = "upload/";
    $target_file = $target_dir . $_FILES["imgprofilo"]["name"];
    $target_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if($target_type != "jpg" && $target_type != "jpeg" && $target_type != "png")
    {
        $_SESSION["messaggio"] = "Errore: sono ammessi solo i formati JPG, JPEG e PNG";
        header("Location: ./index.php");
        exit;
    }

    if(move_uploaded_file($_FILES["imgprofilo"]["tmp_name"], $target_file))
    {
        $sql = "UPDATE Persona SET URLimmagine = '$target_file' WHERE ID = 1";
        $result = $conn->query($sql);
        $_SESSION["messaggio"] = "Il file è stato caricato correttamente";
        header("Location: ./index.php");
    }
    else
    {
        $_SESSION["messaggio"] = "Errore durante il caricamento";
        header("Location: ./index.php");
    }
?>