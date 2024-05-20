<?php
session_start();
if ($_SESSION['log'] == false) {
    $_SESSION['status'] = "Devi effettuare l'accesso prima di poter accedere a questa pagina";
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
        <link rel="stylesheet" href="stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">

    <link href="../css/home.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/profile.css">
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-2 px-lg-5">
            <img src="../img/logo.png" class="me-4" height="7%" width="7%">
            <a class="navbar-brand" href="home.php">Mercatino Meucci</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li>
                        <a href="./sendeed.php">
                            <button class="btn btn-outline-dark me-4 my-1">
                                <i class="bi bi-box-arrow-in-up"></i>
                                Proposte inviate
                                <span class="badge bg-dark text-white ms-1 rounded-pill">
                                    <?php
                                    include ('../connessione.php');
                                    $id = $_SESSION['id'];
                                    $query = "SELECT COUNT(*) as num FROM proposta WHERE proposta.idUtente='$id'";
                                    $result = $conn->query($query);
                                    $row = $result->fetch_assoc();
                                    echo $row['num'];
                                    ?>
                                </span>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href="./recived.php">
                            <button class="btn btn-outline-dark me-5 my-1">
                                <i class="bi bi-box-arrow-in-down"></i>
                                Proposte ricevute
                                <span class="badge bg-dark text-white ms-1 rounded-pill">
                                    <?php
                                        include ('../connessione.php');
                                        $id = $_SESSION['id'];
                                        $query = "SELECT COUNT(*) as num FROM proposta JOIN annuncio ON annuncio.id=proposta.idAnnuncio WHERE annuncio.idUtente='$id'";
                                        $result = $conn->query($query);
                                        $row = $result->fetch_assoc();
                                        echo $row['num'];
                                    ?>
                                </span>
                            </button>
                        </a>
                    </li>
                    <li>
                        <a href="./profile.php">
                            <button class="btn btn-outline-dark my-1">
                                <i class="bi bi-person-circle"></i>
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="card">
            <div class="upper">
                <img src="https://i.imgur.com/Qtrsrk5.jpg" class="img-fluid">
            </div>

            <div class="user text-center">
                <div class="profile">
                    <?php
                        $sql = "SELECT foto_profilo FROM utente WHERE id = '$id'";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $url = $row["foto_profilo"];
                        echo "<img src='$url' class='rounded-circle' width='80' id='openModal'>";
                    ?>
                </div>
                
                <div class="modal" id="modal">
                    <div class="modal-inner">
                        <form method="POST" action="../back-end/img_profilo.php" enctype="multipart/form-data">
                            <div>
                                <?php
                                    $sql = "SELECT foto_profilo FROM utente WHERE id = '$id'";
                                    $result = $conn->query($sql);
                                    $row = $result->fetch_assoc();
                                    $url = $row["foto_profilo"];
                                    echo "<img src='$url' class='rounded-circle' width='150'  height='150' id='openModal'>";
                                ?>
                            </div>
                            <label for="file">Seleziona un'immagine da caricare</label>
                            <br><br>
                            <input type="file" name="imgprofilo" class="text-center" accept="image/*">
                            <br><br>
                            <div>
                                <button type="button" class="button" id="closeModal">CHIUDI</button>
                                <input type="submit" class="button" value="INVIA" name="submit" id="closeModal">
                            </div>
                        </form>
                    </div>
                </div>
                
            </div>
            <div class="mt-5 text-center">
                <h4 class="mb-0">
                    <?php
                        $id = $_SESSION['id'];
                        $query = "SELECT nome,cognome FROM utente WHERE id='$id'";
                        $result = $conn->query($query);
                        $row = $result->fetch_assoc();
                        echo $row['nome'];
                        echo " ";
                        echo $row['cognome'];
                    ?>
                </h4>
                <span class="text-muted d-block mb-2">
                    <?php
                        $id = $_SESSION['id'];
                        $query = "SELECT classe FROM utente WHERE id='$id'";
                        $result = $conn->query($query);
                        $row = $result->fetch_assoc();
                        echo "Classe: ".$row['classe']."  ";
                        function calcolaEta($dataNascita) 
                        {
                            $dataNascita = new DateTime($dataNascita);
                            $dataCorrente = new DateTime();
                            $differenza = $dataNascita->diff($dataCorrente);
                            $eta = $differenza->y;
                            return $eta;
                        }
                        $sql = "SELECT eta FROM utente WHERE id = $id";
                        $result = $conn->query($sql);
                        $row = $result->fetch_assoc();
                        $dataNascita = $row["eta"];
                        $eta = calcolaEta($dataNascita);
                        echo "Eta: $eta";
                    ?>
                </span>
                <hr>
                <div class="justify-content-between align-items-center text-center mt-4 px-4">
                    <div class="stats text-center">
                        <h6 class="mb-0">Annunci attivi</h6>
                        <span>
                            <?php
                                $id = $_SESSION['id'];
                                $query = "SELECT COUNT(*) as num FROM annuncio WHERE idUtente='$id'";
                                $result = $conn->query($query);
                                $row = $result->fetch_assoc();
                                echo $row['num'];
                            ?>
                        </span>
                    </div>
                </div>
                <hr>
                <div>
                    <a href="../login/logout.php"><button class="my-2" style="background-color: blue;border-radius: 20px;color: #fff;cursor: pointer;padding: 10px 25px;">logout</button></a>
                    <a href="../front-end/insert_item.php"><button class="my-2" id='openModalarticolo' style="background-color: blue;border-radius: 20px;color: #fff;cursor: pointer;padding: 10px 25px;">carica articolo</button></a>
                </div>
            </div>
        </div>
    </div>
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                <?php
                    $id = $_SESSION['id'];
                    $query = "SELECT * FROM annuncio JOIN categoria ON annuncio.idCategoria=categoria.id WHERE idUtente='$id'";
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) 
                    {
                        while ($row = $result->fetch_assoc()) 
                        {
                            echo "<div class='col mb-5'>";
                                echo "<div class='card h-100'>";
                                    echo "<img class='card-img-top' src='" . $row['urlFoto'] . "' />";
                                    echo "<div class='card-body p-4'>";
                                        echo "<div class='text-center'>";
                                            echo "<h5 class='fw-bolder'>" . $row['titolo'] . "</h5>";
                                            echo $row['descrizione'];
                                        echo "</div>";
                                    echo "</div>";
                                    echo "<div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>";
                                        echo "<div class='text-center'><a class='btn btn-outline-dark mt-auto' href='#'>View options</a></div>";
                                    echo "</div>";
                                echo "</div>";
                        }
                    } 
                    else 
                    {
                        echo "<p>Nessun annuncio caricato.</p>";
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/script.js"></script>
</body>
</html>