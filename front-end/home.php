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
        <div class="card" style="width: 18rem;">
        <img src="//path foto " class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
        </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
