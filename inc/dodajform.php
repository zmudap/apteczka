<?php
    include("funkcje.php");
	include "nagl.php";
	require_once "connect.php";

    $nazwa=$_GET["nazwa"];
    $postac=$_GET["postac"];
	$id_lek=$_GET["id"];
	

?>

<div id="container">
	<div class="rectangle">
		<button  class="btn btn-primary" type="button" style="text-decoration:none;color:#ffffff;"><a href="index.php">Powrót</a></button>
		
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
					<input name="save" type="submit" class="btn btn-primary" value="Dodaj lek do apteczki"/>
			</form>
		</div>
	</div>
</div>
