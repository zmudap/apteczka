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

  if(isset($_GET['usun']))
  {

    $id = $_GET['usun'];
    $nazwa = $_GET['nazwa'];


    $sql ="DELETE FROM leki_w_apteczkach WHERE leki_w_apteczkach.id_leku_w_apteczce=$id";

    if($polaczenie->query($sql) === TRUE) {
      header ('Location:zawartoscapteczki.php');
      
    } else {
      echo "<br> Error: " . $sql . "<br>" . $polaczenie->error;
    }

  }


?>