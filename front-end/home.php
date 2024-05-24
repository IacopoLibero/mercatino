<?php
    session_start();
    if($_SESSION['log'] ==false )
    {
        $_SESSION['status']="Devi effettuare l'accesso prima di poter accedere a questa pagina";
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
        <title>home page</title>
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="../css/home.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container px-2 px-lg-5">
                <img src="../img/logo.png" class="me-4" height="7%" width="7%">
                <a class="navbar-brand" href="#!">Mercatino Meucci</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li>
                            <a href="./sendeed.php">
                                <button class="btn btn-outline-dark me-4 my-1" >
                                    <i class="bi bi-box-arrow-in-up"></i>
                                        Proposte inviate
                                    <span class="badge bg-dark text-white ms-1 rounded-pill">
                                        <?php
                                            include('../connessione.php');
                                            $id=$_SESSION['id'];
                                            $query="SELECT COUNT(*) as num FROM Proposta WHERE Proposta.idUtente='$id'";
                                            $result=$conn->query($query);
                                            $row=$result->fetch_assoc();
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
                                            include('../connessione.php');
                                            $id=$_SESSION['id'];
                                            $query="SELECT COUNT(*) as num FROM Proposta JOIN Annuncio ON Annuncio.id=Proposta.idAnnuncio WHERE Annuncio.idUtente='$id'";
                                            $result=$conn->query($query);
                                            $row=$result->fetch_assoc();
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
        <!-- Header-->
        <header class="bg-dark py-5">
            <div class="container px-4 px-lg-5 my-5">
                <div class="text-center text-white">
                    <h1 class="display-4 fw-bolder">Shop in style</h1>
                    <p class="lead fw-normal text-white-50 mb-0">Discover amazing deals</p>
                </div>
            </div>
        </header>
        <!-- Section-->
        <section>
            <div class="px-4 px-lg-5 mt-5 ">
                <div class=" row justify-content-center">
                    <?php
                        $id = $_SESSION['id'];
                        $query = "SELECT Annuncio.id,Annuncio.nome as nome ,Categoria.nome as categoria,Annuncio.descrizione,Utente.email as mail,Utente.id as id_da_mostrare FROM Annuncio JOIN Categoria ON Annuncio.idCategoria=Categoria.id JOIN Utente ON Annuncio.idUtente=Utente.id WHERE Annuncio.idUtente!='$id'";
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
                                                echo "<img class='d-block w-100' src='" . $rowfoto['url_foto'] . "' height='30%' width='30%'>'";
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
                                        $_SESSION['utente_da_mostrare']=$row['id_da_mostrare'];
                                    echo "</div>";
                                    echo "<div class='card-body p-4'>";
                                        echo "<div class='text-center poetsen-one-regular'>";
                                            echo "<h5 class='card-title '>" . $row['nome'] . "</h5>";
                                            echo "<p class='card-text'>" . $row['categoria'] . "</p>";
                                            echo "<p class='card-text'>" . $row['descrizione'] . "</p>";
                                            echo "<a href='mostra_utente.php' class='card-text'>" . $row['mail'] . "</a>";
                                            
                                        echo "</div>";
                                    echo "</div>";
                                    echo '<div class="card-footer p-4 pt-0 border-top-0 bg-transparent">';
                                        echo '<div class="text-center"><a class="btn btn-outline-dark mt-auto" href="../back-end/send_proposta.php">Fai una proposta</a></div>';
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
        <script src="js/scripts.js"></script>
    </body>
</html>
