<?php
	include("nagl.php");
	include("funkcje.php");
	include("connect.php"); 
  //header("Location: mojeleki.php");
?>

<div id="container">
	<div class="rectangle">
		</form>
			<div class="form">
			<form action="inc/wydaj.php" method="GET">
                    <label for="apteczka">Wybierz apteczkę: </label>
                    <select id="apteczka" name = "apteczka">
                        <?php
                            include 'wyborapteczki.php';
                        ?>
                    </select> <br/><br/>
					
                    <label for="leki">Wybierz lek: </label>
                    <select id="id_leku" name = "id_leku">

                    <?php
                        require_once 'connect.php';
                        mysqli_report(MYSQLI_REPORT_STRICT);

                        try{  
                            $polaczenie = new mysqli($host, $db_user,$db_password, $db_name);
                            if($polaczenie->connect_errno!=0){
                                throw new Exception(mysqli_connect_errno());
                            }
                            else{
                                $rezultaty = $polaczenie->query("SELECT * FROM leki_w_apteczkach WHERE leki_w_apteczkach.id_apteczki = $Aktualna_apteczka");
                                if(!$rezultaty) throw new Exception($polaczenie->error);
                                else{
                                    while($row = $rezultaty->fetch_row()){
                                        echo '<option value="'.$row[0].'">'.$row[2].'</option>';
                                        $nazwa = $row[2];
                                    }
                                }
                                $rezultaty->free_result();
                                $polaczenie->close();
                            }
                        }
                        catch(Exception $e){
                            echo "blad polaczenia z baza";
                        }
                    ?></select> <br/> <br/>

					<div class="form-group col-md-3">
						<input class = "btn btn-primary btn-block" type="submit" class="btn_1" name="wydaj" value="Wydaj lek"/>
					</div>
			</form>
		</div>
	</div>
</div>