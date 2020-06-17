<?php
    include("funkcje.php");
	include "nagl.php";
	require_once "connect.php";

    $nazwa=$_GET["nazwa"];
    $postac=$_GET["postac"];
	$id_lek=$_GET["id"];
	



	$polaczenie=@new mysqli($host, $db_user, $db_password, $db_name);

	if($polaczenie->connect_errno!=0)
	{
	echo "Error:".$polaczenie->connect_errno;
	}


	if(isset($_GET['save']))
	{
	$postac = $_GET['postac'];
	$nazwa = $_GET['nazwa'];
	$id = $_GET['id'];
	$ilosc = $_GET['ilosc'];
	$data = $_GET['data'];
	$cena = $_GET['cena'];
	$apteczka =$_GET['apteczka'];

	$sql = "INSERT INTO leki_w_apteczkach VALUES (NULL,'$id', '$nazwa','$postac', '$apteczka','$data', '$ilosc','$cena')";
		//echo $sql;
		if ($polaczenie->query($sql) === TRUE) {

			echo "<br> Dodano nowy lek: $nazwa";

			

			
		} else {
			echo "<br> Error: " . $sql . "<br>" . $polaczenie->error;
		}


	}

?>

<div id="container">
	<div class="rectangle">
		<button  class="btn btn-primary" type="button"><a href="index.php">Powrót</a></button>
		
		</form>
		<div class="form">
		<form action = "dodajfunkcja.php" method="GET">
					<p>Aby dodać lek, należy uzupełnić wszystkie pola formualrza </p>
					<label for="apteczka">Wybierz apteczkę: </label>
                    <select id="apteczka" name = "apteczka">
                        <?php
                            include 'wyborapteczki.php';
                        ?>
                    </select> <br/><br/>
					Nazwa: <input type="text" name="nazwa" value="<?php echo $nazwa; ?>"required readonly><br /><br />
					Postać: <input type="text" name="postac"value="<?php echo $postac; ?>" required readonly><br /><br />
					ID: <input type="text" name="id"value="<?php echo $id_lek; ?>" required readonly><br /><br />
					Ilość (szt./ml.): <input type="number" name="ilosc" min = "1" value = "0" step="1"required><br /><br/>
					Termin ważności: <input type="date" name="data" required><br /><br/>
					Cena [PLN]: <input type="number" name="cena" min="0.00" value = "0" step = "0.01" required><br /><br/>
					<input name="save" type="submit" class="btn_1" value="Dodaj lek do apteczki"/>
			</form>
		</div>
	</div>
</div>
