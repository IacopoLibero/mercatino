<?php
    session_start();
    include('../connessione.php');

    $nome = $_POST['nome'];
    //controllo che il come sia stato passato correttamente
    if (strpos($nome, ',') === false) {
        $_SESSION['status_reg'] = "Il campo nome deve contenere una virgola.";
        header("Location: ../index.php");
        exit();
    }
    $nomeArray = explode(',', $nome);
    $nome = $nomeArray[0];
    $cognome = $nomeArray[1];
    $email = $_POST['email'];
    $classe=$_POST['classe'];
    $username = $nome."_".$classe;
    $data_nascita = $_POST['data_nascita'];
    $password = $_POST['pw'];

    // Controllo se la password soddisfa i requisiti
    if (!preg_match("/^(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z]).{8,}$/", $password)) {
        $_SESSION['status_reg'] = "La password deve essere di almeno 8 caratteri, contenere una lettera maiuscola, una cifra e un carattere speciale.";
        header("Location: ../index.php");
        exit();
    }
    

    $password = hash("sha256", $password);

    // Controllo se l'Utente è già registrato
    $checkQuery = "SELECT * FROM Utente WHERE email = '$email'";
    $result = $conn->query($checkQuery);

    // Se non è registrato lo inserisco nel database, altrimenti mostro un errore
    if($result->num_rows == 0)
    {
        $query = "INSERT INTO Utente (username,password,nome,cognome,email,eta,classe) VALUES ('$username','$password','$nome', '$cognome', '$email','$data_nascita','$classe')";
        if ($conn->query($query)) 
        {
            $_SESSION['status'] = "Registrazione effettuata";
            header("Location: ..\index.php");
        } 
        else 
        {
            $_SESSION['status_reg'] = "Email gia esistente";
            header("Location: ../index.php");
        }
    }
    else 
    {
        $_SESSION['status_reg'] = "Utente gia esistente";
        header("Location: ../index.php");
    }
?>