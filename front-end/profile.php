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
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Your profile</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
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

                        if($url != NULL)
                        {
                            echo "<img src='$url' class='rounded-circle' width='80' id='openModal'>";
                        }
                        else
                        {
                            echo "<img src='../img/empty.png' class='rounded-circle' width='80' id='openModal'>";
                        }
                    ?>
                </div>
                <!-- 
                <div class="modal" id="modal">
                    <div class="modal-inner">
                        <form method="post" action="gestione.php" enctype="multipart/form-data">
                            <label for="file">Seleziona un'immagine da caricare</label>
                            <br><br>
                            <input type="file" name="imgprofilo" accept="image/png, image/gif, image/jpeg">
                            <br><br>
                            <input type="submit" value="INVIA" name="submit">
                        </form>
                    </div>
                </div>
                -->
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
            </div>
        </div>
    </div>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>