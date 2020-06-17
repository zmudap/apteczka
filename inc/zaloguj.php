<?php
  session_start();
  require_once "connect.php";

  if(!isset($_POST['login']) || (!isset($_POST['haslo'])))
  {
    header('Location:start.php');
    exit();
  }

  $polaczenie= @new mysqli($host, $db_user, $db_password, $db_name);
  if($polaczenie->connect_errno!=0)
  {
    echo "Error:".$polaczenie->connect_errno;
  }else
  {

  $login = $_POST['login'];
  $haslo = $_POST['haslo'];

  $login = htmlentities($login, ENT_QUOTES, "UTF-8");

  
  if ($rezultat = @$polaczenie->query(sprintf("SELECT * FROM login WHERE user='%s'", mysqli_real_escape_string($polaczenie,$login))))
  {
    $ilu_userow = $rezultat->num_rows;
    if($ilu_userow>0)
    {
      $wiersz = $rezultat->fetch_assoc();

      if(password_verify($haslo, $wiersz['pass']))
      $_SESSION['zalogowany']=true;
      $_SESSION['id_zalogowany']=$wiersz['id_uzytkownika'];
      
      

      $_SESSION['user'] = $wiersz['user'];

      unset($_SESSION['blad']);


      $rezultat->close();
      header('Location: index.php');
    }else
    {
      $_SESSION['blad']="Nieprawidłowy login lub hasło!";
      header('Location: start.php');
    }
  }else
  {
    $_SESSION['blad']="Nieprawidłowy login lub hasło!";
    header('Location: start.php');
  }
  $polaczenie->close();
  }

?>