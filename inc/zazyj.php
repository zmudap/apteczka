<div><input class="btn btn-primary" type="button" onClick="location.href='index.php?case=302'" value = "Powrót"></div>

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
    $sql ="UPDATE leki_w_apteczkach SET leki_w_apteczkach.ilosc = leki_w_apteczkach.ilosc-1 WHERE leki_w_apteczkach.id_leku_w_apteczce=$id";
    $data = date('Y-m-d H:i:s');
    $id_lek = $_GET['usun'];

    if($polaczenie->query($sql) === TRUE) {
      echo "Usunięto lek z apteczki!";
      $polaczenie->query("INSERT INTO Operacje_w_apteczkach VALUES (NULL,'Zazyto','$id_lek', NULL, '1', '$data',NULL)");

      
    } else {
      echo "<br> Error: " . $sql . "<br>" . $polaczenie->error;
    }

  }


?>