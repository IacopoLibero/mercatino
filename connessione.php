<?php
    // Definizione delle variabili per la connessione al database
    $servername = "localhost";
    $username = "bernabei5c1";
    $password = "";
    $dbname = "my_bernabei5c1";

    /*
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "mercatino";f
    */

    mysqli_report(MYSQLI_REPORT_OFF);  // Serve a disabilitare le eccezioni nelle nuove versioni di PHP

    // Creazione della connessione al database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Controllo della connessione
    if ($conn->connect_error) {
        echo("Connection failed: " . $conn->connect_error);
    }
?>