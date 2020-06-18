<?php
	if(!isset($_SESSION['zalogowany']))
    {
        header('Location: start.php');
        exit();
	}
	require_once "connect.php";	
?>
		<div id="container">
			Aby dodać lek, wyszukaj go w bazie:
			<form action="inc/wyszukanieleku.php" method="GET">
			Klucz wyszukiwania: <select name="sposob" id="sposob">
				<option value="NazwaHandlowa" >Nazwa</option>
				<option value="id" >ID</option>
				<option value="Postac" >Postać</option>
				<option value="KodKreskowy" >Kod kreskowy</option>
			  </select><br/><br />
			  
			  <input type="text" name="search" placeholder="Wartość klucza"required>
			   		<input type="submit" class="btn btn-primary" value="Wyszukaj">
			</form>
		</div>		
<?php
	//add($username, $connection, $table, $_POST['nazwa'], $_POST['postac'], $_POST['DATA'], $_POST['ilosc']);
	
	
?>