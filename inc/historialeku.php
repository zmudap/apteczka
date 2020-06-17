<?php
  if(!isset($_SESSION['zalogowany']))
  {
    header('Location:start.php');
    exit();
  }
  $zalogowany = $_SESSION['user'];
?>

<div class = "containter">
    <div class = "row">
      <form method = 'post'>
        <div class = "form-group col-md-8">
            <label for="apteczka">Prześledź historię apteczki</label>
            <select id="apteczka" name = "apteczka">              
                <?php
                  include 'wyborapteczki.php';
                ?>
            </select> 
        </div>
        
        <div class="form-group col-md-8">
          <input class = "btn btn-primary btn-block" type="submit" value = "Sprawdź historię apteczki">  
        </div>
    </form>
</div>

<?php
    if(isset($_POST['apteczka']))
    {
    $id_apteczki = $_POST['apteczka'];

?>
<div class = "container">
    <div class = "row">
    <input type="text" id="myInput1" onkeyup="myFunction(0,id)" placeholder="Szukaj operacji.." title="Type in a name">
    </div>
</div>
<?php
    echo '<input type="text" id="myInput1" onkeyup="myFunction(0,id)" placeholder="Szukaj operacji.." title="Type in a name">';
    echo '<input type="text" id="myInput2" onkeyup="myFunction(1,id)" placeholder="Szukaj leku.." title="Type in a name">';
    echo '<input type="text" id="myInput3" onkeyup="myFunction(2,id)" placeholder="Szukaj uzytkownika.." title="Type in a name">';
    echo '<label for="data1">Od: </label>';
    echo '<input type="date" id = "data1" name="datawaznosci">';
    echo '<label for="data2">Do: </label>';
    echo '<input type="date" id = "data2" name="datawaznosci">';
    echo '<button type="button" id = "button1" onclick = "showDate()" >Filtruj datę</button>';
    echo '<table class = "table" id = "myTable"><tr class = "thead-dark"><th>Rodzaj operacji</th><th>Nazwa leku</th><th>Użytkownik</th><th>Data</th></tr>';
    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try{  
      $polaczenie = new mysqli($host, $db_user,$db_password, $db_name);
      if($polaczenie->connect_errno!=0)
      {
        throw new Exception(mysqli_connect_errno());
      }
      else{
        $rezultaty = $polaczenie->query("SELECT Operacje_w_apteczkach.nazwa_operacji, ListaLekow.NazwaHandlowa, login.user ,Operacje_w_apteczkach.data FROM Operacje_w_apteczkach,ListaLekow, login WHERE Operacje_w_apteczkach.id_lek=ListaLekow.id AND Operacje_w_apteczkach.id_apteczki=$id_apteczki AND Operacje_w_apteczkach.id_uzytkownika=login.id_uzytkownika ORDER BY Operacje_w_apteczkach.data DESC");
          if(!$rezultaty) throw new Exception($polaczenie->error);
          else{
            while($row = $rezultaty->fetch_row())
            {
              echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td></tr>';                            
            }
          }
          $rezultaty->free_result();
          $polaczenie->close();                    
          }
    }
    catch(Exception $e){
      echo $e->getMessage();
      echo "Blad polaczenia z baza";
    }
  }
?>
</div>