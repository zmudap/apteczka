<?php
  session_start();
  include "nagl.php";
  include "funkcje.php";
  include "connect.php";
  if(!isset($_SESSION['zalogowany']))
  {
    header('Location: start.php');
    exit();
  }
  
  $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
  if($polaczenie->connect_errno!=0)
  {
    echo "Error: ".$polaczenie->connect_errno;
  }

  if(isset($_GET['wydaj']))
  {
    $nazwa = $_SESSION['nazwa'];
    $id = $_GET['id_leku'];
    $apteczka = $_GET['apteczka'];

    $sql ="DELETE FROM leki_w_apteczkach WHERE leki_w_apteczkach.id_leku_w_apteczce=$id AND id_apteczki=$apteczka";

    if($polaczenie->query($sql) === TRUE) {
      echo "<br> Wydano lek: $nazwa";
      header ('Location:zawartoscapteczki.php');
      
    } else {
      echo "<br> Error: " . $sql . "<br>" . $polaczenie->error;
    }

  }


?>