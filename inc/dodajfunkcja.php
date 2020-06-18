<?php

session_start();
include "nagl.php";
include "funkcje.php";
include "connect.php";

$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);

if($polaczenie->connect_errno!=0)
{
  echo "Error:".$polaczenie->connect_errno;
}


if(isset($_GET['save']))
{
  $rodzaj = "Dodano";
  $data = date('Y-m-d H:i:s');
  $postac = $_GET['postac'];
  $nazwa = $_GET['nazwa'];
  $id = $_GET['id'];
  $ilosc = $_GET['ilosc'];
  $data_waznosci = $_GET['data'];
  $cena = $_GET['cena'];
  $apteczka =$_GET['apteczka'];
  $id_uzytkownika = $_SESSION['user'];

  $polaczenie->query("INSERT INTO Operacje_w_apteczkach VALUES (NULL,'$rodzaj','$id','$apteczka','$ilosc','$data','$id_uzytkownika')");

  $sql = "INSERT INTO leki_w_apteczkach VALUES (NULL,'$id', '$nazwa','$postac', '$apteczka','$data_waznosci', '$ilosc','$cena')";
	//echo $sql;
	if ($polaczenie->query($sql) === TRUE) {

        echo "<br> Dodano nowy lek: $nazwa";



		
	} else {
		echo "<br> Error: " . $sql . "<br>" . $polaczenie->error;
	}


}

?>
<br/> <br/>
<button  class="btn btn-primary" type="button" style = "text-decoration:none; color:#ffffff;"><a href="index.php">Powrót do strony głównej</a></button>