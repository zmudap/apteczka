<?php
	function show($table, $conn)
	{
	$zapytanie = "SELECT * FROM $table";
	$result = $conn->query($zapytanie);
?>
<h3>Baza Leków</h3>
	
<div id="table-wrapper">
<div id="table-scroll">
<table>
		<thead>
			<tr>
				<th>Id</th>
				<th>Nazwa</th>
				<th>Postać</th>
				<th>Kod kreskowy</th>
			</tr>
		</thead>
		<tbody>

<?
	
	echo "Liczba leków w bazie ". $result->num_rows . "<br><br>";
	
		//wyswietlanie tabeli
	if($result->num_rows > 0)
	{
		while($row = $result->fetch_assoc())
		{
			echo'
			<tr>
				<td>'.$row["id"].'</td>
				<td>'.$row["NazwaHandlowa"].'</td>
				<td>'.$row["Postac"].'</td>
				<td>'.$row["KodKreskowy"].'</td>
			</tr>';
		}
	} 
	else 
	{
		echo "Zwrócono 0 rekordów";
	}
	$result->close();
}
?>
		</tbody>
		</table>
</div>
</div>

<?php
function find($table, $conn, $value, $sposob)
	{
		if($sposob=="id"){$zapytanie = "SELECT * FROM $table WHERE $sposob='$value'" ;
	}
	else
	{
		$zapytanie = "SELECT * FROM $table WHERE $sposob LIKE '$value%' OR $sposob LIKE '%$value' OR $sposob='$value' ";
	}		
	$result = $conn->query($zapytanie);
	
	if (!$result) 
	{
		trigger_error('Invalid query: ' . $conn->error);   //bład połaczenia 
	}
	
?>
	
	<div id="container">
	<h3>Wyniki wyszukiwania</h3>
	
	<div id="table-wrapper">
	<div id="table-scroll">
	<table class="w3-table-all">
			<thead>
				<tr>
					<th>Id</th>
					<th>Nazwa</th>
					<th>Postać</th>
					<th>Kod kreskowy</th>
					<th>Dodaj do Mojej Apteczki</th>
				</tr>
			</thead>
			<tbody>
	<?
	if($result->num_rows > 0){
		
		while($row = $result->fetch_assoc()){
			echo'
			<tr>
				<td>'.$row["id"].'</td>
				<td>'.$row["NazwaHandlowa"].'</td>
				<td>'.$row["Postac"].'</td>
				<td>'.$row["KodKreskowy"].'</td>
				<td><form action ="dodajform.php" method="GET"><input type="hidden" name="nazwa" value="'.$row["NazwaHandlowa"].'"><input type="hidden" name="postac" value="'.$row["Postac"].'"><input type="hidden" name="id" value="'.$row["id"].'"><input  type="submit" class="btn btn-primary" value="Dodaj do apteczki"></form></td>
			</tr>';
		}
	} else {
		echo "Zwrócono 0 rekordów";
	}$result->close();


?>
		</tbody>
		</table>
		
</div>
</div>
</div>

<?
}
?>


