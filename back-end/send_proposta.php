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
        $prezzo=$_POST['prezzo'];
    }
?>