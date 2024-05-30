<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poetsen+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v2.1.9/css/unicons.css">
  <link rel="stylesheet" href="./css/index.css">
</head>
<body>
<div id="stars"></div>
<div id="stars2"></div>
<div id="stars3"></div>
<div class="section">
  <div class="container">
    <div class="row full-height justify-content-center">
      <div class="col-12 text-center align-self-center py-5">
        <div class="section pb-5 pt-5 pt-sm-2 text-center">
          <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                <input class="checkbox" type="checkbox" id="reg-log" name="reg-log"/>
                <label for="reg-log"></label>
          <div class="card-3d-wrap mx-auto">
            <div class="card-3d-wrapper">
              <div class="card-front">
                <div class="center-wrap">
                  <div class="section text-center">
                    <h4 class="mb-4 pb-3">Log In</h4>

                    <form method="POST" action="login/login.php">
                      <div class="form-group">
                        <input type="email"  name="email" required class="form-style" placeholder="cognome.nome@itismeucci.com">
                        <i class="input-icon uil uil-at"></i>
                      </div>	
                      <div class="form-group mt-2 ">
                        <input type="password" name="pw" id="psw" required placeholder="password" class="form-style">
                        <i class="input-icon uil uil-lock-alt"></i>
                        
                      </div>
                      <input type="submit" class="btn mt-4"  required value="Accedi">
                    </form>
                    <?php
                      session_start();
                      if(isset($_SESSION['status']))
                      {
                          echo "<br>";
                          if($_SESSION['status'] == "Registrazione effettuata"||$_SESSION['status']=="Logout effettuato con successo")
                          {
                              echo "<label class='text-success'>".$_SESSION['status']."</label>";
                              session_unset();
                          }
                          else
                          {
                              echo "<label class='text-danger'>".$_SESSION['status']."</label>";
                              session_unset();
                          }
                      }
                      if (isset($_SESSION['status_reg'])) 
                      {
                          echo "<label class='text-danger'>".$_SESSION['status_reg']."</label>";
                          session_unset();
                      }            
                    ?>
                      </div>
                    </div>
                  </div>
              <div class="card-back">
                <div class="center-wrap">
                  <div class="section text-center">
                    <h4 >Sign Up</h4>
                    <form method="POST" action="login/scriptregistrazione.php">
                    <div class="form-group">
                      <input type="text" name="nome" class="form-style" required placeholder="Nome e cognome divisi da una virgola">
                      <i class="input-icon uil uil-user"></i>
                    </div>
                    <div class="form-group mt-2">
                      <input type="email" name="email" class="form-style" placeholder="Email">
                      <i class="input-icon uil uil-at"></i>
                    </div>
                    <div class="form-group mt-2">
                      <input type="text" name="classe" class="form-style" placeholder="Classe" maxlength="2">
                      <i class="input-icon bi bi-mortarboard"></i>
                    </div>
                    <div class="form-group mt-2">
                      <input type="date" name="data_nascita" class="form-style" placeholder="yyyy-mm-dd">
                      <i class="input-icon bi bi-calendar2-day"></i>
                    </div>
                    <div class="form-group mt-2">
                      <input type="password" class="form-style" name="pw" placeholder="Password">
                      <i class="input-icon uil uil-lock-alt"></i>
                    </div>
                    <input type="submit" class="btn mt-2"  value="Registrati">
                    </form>
                    
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
</body>
</html>