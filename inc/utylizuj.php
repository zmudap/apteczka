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
    $sql ="DELETE FROM leki_w_apteczkach WHERE leki_w_apteczkach.id_leku_w_apteczce=$id";
    $data = date('Y-m-d H:i:s');
    $id_lek = $_GET['usun'];
    $id_uzytkownika = $_SESSION['user'];
    $apteczka = $_SESSION['apteczka'];


    if($polaczenie->query($sql) === TRUE) {
      echo "Usunięto lek z apteczki!";
      $polaczenie->query("INSERT INTO Operacje_w_apteczkach VALUES (NULL,'Utylizacja','$id_lek', '$apteczka', '1', '$data','$id_uzytkownika')");

      
    } else {
      echo "<br> Error: " . $sql . "<br>" . $polaczenie->error;
    }

  }


?>