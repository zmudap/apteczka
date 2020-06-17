<?php
  session_start();
  include "inc/nagl.php";
  include "inc/baza.php";
  include "inc/zapytania.php";
  
  if(!isset($_SESSION['udana_rejestracja']))
  {
    header('Location:../start.php');
    exit();

  }
  else{
    unset($_SESSION['udana_rejestracja']);
  }

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>logowanie</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Dark.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body style="background-color: rgb(208,234,255);">
    <div class="login-clean" style="background-color: rgb(208,234,255);">
        <form action = "inc/zaloguj.php" method="post">
            <h2 class="sr-only"></h2>
            <div class="illustration"><i class="fas fa-stethoscope"></i></div>
            <div class = "form-group"><h4>Dziękujemy za rejestrację, możesz zalogować się na swoje konto!</h4></div>
            <div class="form-group"><input class="btn btn-primary btn-block" type="button" onClick="location.href='start.php'" value = "Zaloguj się!"></input></div>
        </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <?php
    if(isset($_SESSION['blad'])) echo $_SESSION['blad'];

  ?>
  <div class="container">

  </div>
</body>

</html>