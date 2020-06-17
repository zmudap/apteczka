<?php
  session_start();
  include "inc/nagl.php";
  include "inc/baza.php";
  include "inc/zapytania.php";
  if(isset($_SESSION['zalogowany']) && ($_SESSION['zalogowany']==true))
  {
    header('Location:index.php');
    exit();
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
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body style="background-color: rgb(208,234,255);">
    <div class="login-clean" style="background-color: rgb(208,234,255);">
        <form action = "zaloguj.php" method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="fas fa-stethoscope"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="login" placeholder="Login" required=""></div>
            <div class="form-group"><input class="form-control" type="password" name="haslo" placeholder="Password" required=""></div>

            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Zaloguj się!</button>
            <div class="error">
            <?php
              if(isset($_SESSION['blad'])) echo $_SESSION['blad'];


            ?>
            </div>
            </div><a class="forgot" href="rejestracja.php">Nie posiadam konta.</a>
            
          </form>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>

  <div class="container">

<?php
    include "inc/stopka.php";
?>

  </div>
</body>

</html>