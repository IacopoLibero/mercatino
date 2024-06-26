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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Rubik&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">

    <link href="../css/home.css" rel="stylesheet"/>
    <link href="../css/profile.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/modal.css">
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-2 px-lg-5">
            <img src="../img/logo.png" class="me-4 logo" height="7%" width="7%">
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
                                    if (isset($_POST['utente_da_mostrare'])) 
                                    {
                                        $utente_da_mostrare = $_POST['utente_da_mostrare'];
                                    }
                                    
                                    $query="SELECT COUNT(*) as num FROM Proposta WHERE Proposta.idUtente='$id'";
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
                                        $query="SELECT COUNT(*) as num FROM Proposta JOIN Annuncio ON Annuncio.id=Proposta.idAnnuncio WHERE Annuncio.idUtente='$id' ";
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
    <div class="row d-flex justify-content-center align-items-center">
        <div class="card col-12">
            <div class="user text-center profile">
                <?php
                    $sql = "SELECT foto_profilo FROM Utente WHERE id = '$utente_da_mostrare'";
                    $result = $conn->query($sql);
                    $row = $result->fetch_assoc();
                    $url = $row["foto_profilo"];
                    echo "<img src='$url' class='rounded-circle' width='80' id='openModal'>";
                ?>
            </div>
            <div class="mt-5 text-center">
                <h4 class="mb-0">
                    <?php
                        $query = "SELECT nome,cognome FROM Utente WHERE id='$utente_da_mostrare'";
                        $result = $conn->query($query);
                        $row = $result->fetch_assoc();
                        echo $row['nome'];
                        echo " ";
                        echo $row['cognome'];
                    ?>
                </h4>
                <span class="text-muted d-block mb-2">
                    <?php
                        $query = "SELECT classe FROM Utente WHERE id='$utente_da_mostrare'";
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
                        $sql = "SELECT eta FROM Utente WHERE id = $utente_da_mostrare";
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
                                $query = "SELECT COUNT(*) as num FROM Annuncio WHERE idUtente='$utente_da_mostrare'";
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
    <hr>
    <div class="text-center articoli poetsen-one-regular"><h1 >Articoli caricati</h1></div>
    <?php
        $selected_radio = isset($_POST['radio']) ? $_POST['radio'] : 'all';
    ?>
    
    <div class="radio-inputs row text-center">
        <label class="radio col-12">
            <input type="radio" name="radio" value="all" <?php echo ($selected_radio == 'all') ? 'checked' : '' ?>>
            <span class="name">TUTTE LE CATEGORIE</span>
            </label>
            <label class="radio col-6">
            <input type="radio" name="radio" value="inf" <?php echo ($selected_radio == 'inf') ? 'checked' : '' ?>>
            <span class="name">INFORMATICA</span>
            </label>
            <label class="radio col-6">
            <input type="radio" name="radio" value="vid" <?php echo ($selected_radio == 'vid') ? 'checked' : '' ?>>
            <span class="name">VIDEOGIOCHI</span>
            </label>
            <label class="radio col-6">
            <input type="radio" name="radio" value="lib" <?php echo ($selected_radio == 'lib') ? 'checked' : '' ?>>
            <span class="name">LIBRI</span>
            </label>
            <label class="radio col-6">
            <input type="radio" name="radio" value="tel" <?php echo ($selected_radio == 'tel') ? 'checked' : '' ?>>
            <span class="name">TELEFONIA</span>
        </label>
    </div>
    <input type="hidden" name="utente_da_mostrare" value="<?php echo $utente_da_mostrare ?>">
    <section>
        <div class="px-4 px-lg-5 mt-5 ">
            <div class=" row justify-content-center">
                <?php
                    $selected_radio = isset($_POST['radio']) ? $_POST['radio'] : 'all';
                    
                    $id = $_SESSION['id'];
                    $query = "SELECT Annuncio.id,Annuncio.nome as nome ,Categoria.nome as categoria,Annuncio.descrizione FROM Annuncio JOIN Categoria ON Annuncio.idCategoria=Categoria.id WHERE Annuncio.idUtente='$utente_da_mostrare'";
                    if ($selected_radio == 'inf') {
                        $query .= " AND Categoria.nome='informatica'";
                    } elseif ($selected_radio == 'vid') {
                        $query .= " AND Categoria.nome='videogiochi'";
                    } elseif ($selected_radio == 'lib') {
                        $query .= " AND Categoria.nome='libri'";
                    } elseif ($selected_radio == 'tel') {
                        $query .= " AND Categoria.nome='telefonia'";
                    }
                    $id = $_SESSION['id'];
                    $result = $conn->query($query);
                    if ($result->num_rows > 0) 
                    {
                        while ($row = $result->fetch_assoc()) 
                        {
                            echo "<div class='card col-xxl-xl-3 col-lg-4 col-md-6 col-sm-12 mx-3 my-3' style='width: 18rem;'>";
                                echo "<div class='card-img-top'>";
                                    $foto="SELECT url_foto FROM Foto WHERE idAnnuncio=" . $row['id'];
                                    $resultfoto = $conn->query($foto);
                                    if ($resultfoto->num_rows > 0) 
                                    {
                                        $carouselId = 'carouselExampleControls' . $row['id'];
                                        echo "<div id='$carouselId' class='carousel carousel-dark slide' data-bs-ride='carousel'>";
                                        echo "<div class='carousel-inner'>";
                                        $first = true;
                                        while ($rowfoto = $resultfoto->fetch_assoc()) 
                                        {
                                            if ($first) {
                                                echo "<div class='carousel-item active'>";
                                                $first = false;
                                            } else {
                                                echo "<div class='carousel-item'>";
                                            }
                                            echo "<img class='d-block w-100' src='" . $rowfoto['url_foto'] . "' style='height: 300px; width: 300px; object-fit: cover;'>";
                                            echo "</div>";
                                        }
                                        echo "</div>";
                                        echo "<button class='carousel-control-prev' type='button' data-bs-target='#$carouselId' data-bs-slide='prev'>";
                                        echo "<span class='carousel-control-prev-icon' aria-hidden='true'></span>";
                                        echo "<span class='visually-hidden'>Previous</span>";
                                        echo "</button>";
                                        echo "<button class='carousel-control-next' type='button' data-bs-target='#$carouselId' data-bs-slide='next'>";
                                        echo "<span class='carousel-control-next-icon' aria-hidden='true'></span>";
                                        echo "<span class='visually-hidden'>Next</span>";
                                        echo "</button>";
                                        echo "</div>";
                                    }
                                echo "</div>";
                                echo "<div class='card-body p-4'>";
                                    echo "<div class='text-center poetsen-one-regular'>";
                                        echo "<h5 class='card-title '>" . $row['nome'] . "</h5>";
                                        echo "<p class='card-text'>" . $row['categoria'] . "</p>";
                                        echo "<p class='card-text'>" . $row['descrizione'] . "</p>";
                                    echo "</div>";
                                echo "</div>";
                                
                                echo '<div class="card-footer  p-4  pt-0 border-top-0 bg-transparent">';
                                    $offerta = "SELECT prezzo FROM Proposta WHERE idAnnuncio=" . $row['id'] . " AND idUtente=" . $_SESSION['id'];
                                    $resultOfferta = $conn->query($offerta);
                                    if ($resultOfferta->num_rows > 0) 
                                    {
                                        $rowOfferta = $resultOfferta->fetch_assoc();
                                        echo "<br>";
                                        echo "<p class='card-text  text-danger text-center'>Hai già fatto un'offerta di " . $rowOfferta['prezzo'] . "€</p>";
                                    }
                                    else
                                    {
                                        echo "<form method='POST' style='display:flex' action='../back-end/send_proposta.php'>";
                                            echo "<input type='number' name='prezzo' min='1' id='prezzo'>";
                                            echo "<input type='submit' class=' mx-3  btn btn-outline-dark mt-auto' value='Invia la proposta' >";
                                            echo "<input type='hidden' name='id_annuncio' value='" . $row['id'] . "'>";
                                        echo "</form>";
                                    }
                                echo '</div>';
                            echo "</div>";
                        }
                    }
                ?>
            </div>
        </div>
    </section>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../js/script_home.js"></script>
</body>
</html>

<script>
var utente_da_mostrare = <?php echo json_encode($utente_da_mostrare); ?>;

window.onload = function() {
    var radios = document.getElementsByName('radio');

    for(var i = 0; i < radios.length; i++) {
        radios[i].addEventListener('change', function() {
            var form = document.createElement('form');
            form.setAttribute('method', 'post');
            form.setAttribute('action', 'mostra_utente.php');

            var hiddenField = document.createElement('input');
            hiddenField.setAttribute('type', 'hidden');
            hiddenField.setAttribute('name', 'radio');
            hiddenField.setAttribute('value', this.value);

            var hiddenField2 = document.createElement('input');
            hiddenField2.setAttribute('type', 'hidden');
            hiddenField2.setAttribute('name', 'utente_da_mostrare');
            hiddenField2.setAttribute('value', utente_da_mostrare);

            form.appendChild(hiddenField);
            form.appendChild(hiddenField2);
            document.body.appendChild(form);
            form.submit();
        });
    }
}
</script>