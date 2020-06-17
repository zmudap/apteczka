<?php 
  session_start();

  if(isset($_POST['email']))
  {
    // udania walidacja
    $wszystko_dobrze=true;

    // sprawdzany poprawnosc nicka
    $nick = $_POST['nick']; // pobranie zmiennej pomocniczej

    // sprawdzenie dlugosci nicka
    if((strlen($nick)<3) || (strlen($nick)>20))
    {
      $wszystko_dobrze=false;
      $_SESSION['e_nick'] = "Nick musi posiadać od 3 do 20 znaków";
    }

    if(ctype_alnum($nick)==false)
    {
      $wszystko_dobrze=false;
      $_SESSION['e_nick'] = "Nick może się składać tylko z liter i cyfr"; //jak ktos zle napisze to sie pokaze ostatnia
    }

    // Sprawdzenie maila

    $email = $_POST['email'];
    $emailB = filter_var($email, FILTER_SANITIZE_EMAIL); //email po sanityzacji
    if((filter_var($email, FILTER_VALIDATE_EMAIL)==false) || ($emailB!=$email))
    {
      $wszystko_dobrze=false;
      $_SESSION['e_email'] = "Nieprawidłowy adres email";
    }
    //gotowa funkcja do sprawdzenia maila
    // sanityzacja - wyczyszczenie źródła z potencjalnie groxnych zapisów
    //sprawdzanie hasla (czy haslo1==haslo2)

    $haslo1=$_POST['haslo1'];
    $haslo2=$_POST['haslo2'];
    if((strlen($haslo1)<8)|| (strlen($haslo1)>20))
    {
      $wszystko_dobrze=false;
      $_SESSION['e_haslo']="Hasło ma zawierać od 8 do 20 znaków";
    }
    if($haslo1!=$haslo2)
    {
      $wszystko_dobrze=false;
      $_SESSION['e_haslo']="Nieprawidłowe hasło";
    }
    $haslo_hash = password_hash($haslo1, PASSWORD_DEFAULT); // hash niweluje sanityzacje
    
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);
    try
    {
      $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
      if ($polaczenie->connect_errno!=0)
      {
        throw new Exception(mysqli_connect_errno());
      }
      else
      {
        //czy email juz istnieje
        $rezultat = $polaczenie->query("SELECT id_uzytkownika FROM login WHERE email='$email'");

        $ile_takich_maili=$rezultat->num_rows;
        if($ile_takich_maili>0)
        {
          $wszystko_dobrze=false;
          $_SESSION['e_email']="Podany email jest juz zarejestrowany";
        }
        //czy nick istnieje istnieje
        $rezultat = $polaczenie->query("SELECT id_uzytkownika FROM login WHERE user='$nick'");

        $ile_takich_nickow=$rezultat->num_rows;
        if($ile_takich_nickow>0)
        {
          $wszystko_dobrze=false;
          $_SESSION['e_nick']="Podany nick jest juz zarejestrowany";
        }
        if($wszystko_dobrze==true)
        {
          if($polaczenie->query("INSERT INTO login VALUES(NULL, '$nick', '$haslo_hash', '$email', '1')"))
          {
            $_SESSION['udana_rejestracja'] = true;
            header('Location: witamy.php');

          }
          else
          {
            throw new Exception($polaczenie->error);
          }
        }
        $polaczenie->close();
      }
    }

    catch(Exception $e)
    {
      echo "Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w innym terminie!";
      echo '<br/>Informacja deweloperska:'.$e;
    }
    
  }
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Moja domowa apteczka - logowanie</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>

<body style="background-color: rgb(208,234,255);">
    <div class="login-clean" style="background-color: rgb(208,234,255);">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="fas fa-stethoscope"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="nick" placeholder="Podaj swój nick:" required="">
            <?php 
             if (isset($_SESSION['e_nick']))
             {
               echo '<div class = "error">'.$_SESSION['e_nick'].'</div>';
               unset($_SESSION['e_nick']);
             }
             ?>
             </div>
            <div class="form-group"><input class="form-control" type="text" name="email" placeholder="Wpisz swój adres email:" required="">
            <?php 
            if (isset($_SESSION['e_email']))
            {
              echo '<div class = "error">'.$_SESSION['e_email'].'</div>';
              unset($_SESSION['e_email']);
            }
            ?>
            </div>
            <div class="form-group"><input class="form-control" type="password" name="haslo1" placeholder="Wpisz hasło:" required="">
            <?php 
            if (isset($_SESSION['e_haslo']))
            {
              echo '<div class = "error">'.$_SESSION['e_haslo'].'</div>';
              unset($_SESSION['e_haslo']);
            }
            ?>
            </div>
            <div class="form-group"><input class="form-control" type="password" name="haslo2" placeholder="Powtórz hasło:" required="">
            <?php 
            if (isset($_SESSION['e_haslo']))
            {
              echo '<div class = "error">'.$_SESSION['e_haslo'].'</div>';
              unset($_SESSION['e_haslo']);
            }
            ?>
            </div>

            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Zarejestruj się!</button>
            <div class="error">
            <?php
              if(isset($_SESSION['blad'])) echo $_SESSION['blad'];


            ?>
            </div>
            
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