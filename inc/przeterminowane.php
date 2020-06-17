<?php
  if(!isset($_SESSION['user']))
  {
    header('Location:start.php');
    exit();
  }
	require_once "inc/connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($polaczenie->connect_errno != 0)
	{
		echo "Error: ".$polaczenie->connect_errno;
	}
	else
	{
		$przeterminowane = "SELECT nazwa_leku, data_waznosci FROM Leki INNER JOIN ListaLekow ON Leki.id_leku=ListaLekow.id WHERE data_waznosci < NOW() AND id_apteczki in (SELECT id_apteczki FROM apteczki WHERE id_uzytkownika = '". $_SESSION['id_uzytkownika'] ."')";
            $queryResult = $connect->query($przeterminowane);
            if(!$queryResult) throw new Exception($connect->error);
            else
			{
				$wykryteLeki = $queryResult->num_rows;
				if ($wykryteLeki > 0)
				{
					while($row = mysqli_fetch_assoc($queryResult))
					{
						$message = "Skończył się termin ważności leku: " . $row['NazwaHandlowa'];
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
            }
		echo "Blad polaczenia z baza";
	}
	$polaczenie->close();
    exit();    
?>

