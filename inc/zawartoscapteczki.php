<?php
  if(!isset($_SESSION['zalogowany']))
  {
    header('Location:start.php');
    exit();
  }
?>

<div class = "container">
        <div class="row">
            <form method = 'post'>
                <div class ="form-group row">
                    <div class="form-group col-md-8">
                        <label for="apteczka">Wybierz apteczkę</label>
                        <select id="apteczka" name = "apteczka">
                            <?php
                                include 'wyborapteczki.php';
                            ?>
                        </select> 
                    </div>
                    
                    <div class="form-group col-md-7">
                        <input class = "btn btn-primary btn-block" type="submit" value = "Sprawdź zawartość apteczki">  
                    </div>
                </div> 
            </form>
        </div>

        <?php
            if(isset($_POST['apteczka']) || isset($_SESSION['po_usuwaniu']))    
            {
                if(isset($_POST['apteczka']))
                {
                    $id_apteczki = $_POST['apteczka'];
                }
                else
                {
                    $id_apteczki = $_SESSION['po_usuwaniu'];
                }
                    $_SESSION['id_apteczki'] = $id_apteczki;
                
                    require_once 'connect.php';
                    mysqli_report(MYSQLI_REPORT_STRICT);

                    try
                    {  
                        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
                        if($polaczenie->connect_errno!=0)
                        {
                            throw new Exception(mysqli_connect_errno());
                        }
                        else
                        {
                            $rezultaty = $polaczenie->query("SELECT ListaLekow.NazwaHandlowa, leki_w_apteczkach.koszt, leki_w_apteczkach.ilosc, leki_w_apteczkach.data_waznosci, leki_w_apteczkach.id_leku_w_apteczce FROM ListaLekow, leki_w_apteczkach, apteczki WHERE ListaLekow.id=leki_w_apteczkach.id_leku AND leki_w_apteczkach.id_apteczki=$id_apteczki");
                            if(!$rezultaty) throw new Exception($polaczenie->error);
                        
                            else
                            {
                                echo '<div id = "1" class="row">';
                                echo '<form action = "inc/usun.php" method = "post">';
                                echo '<div class = "form-group row">';
                                echo '<table class="table"><tr class="thead-dark"><th>Nazwa leku</th><th>Cena</th><th>Ilość</th><th>Data ważności</th><th><div><input type="submit" name = "action" value="Usun/Utylizuj"></div></th><th><div ><input type="submit" name = "action" value="Zażyj"></div></th></tr>';
                                while($row = $rezultaty->fetch_row())
                                {
                                    $data = new DateTime($row[3]);    
                                    if($data->format('Y-m-d H:i:s')<date('Y-m-d H:i:s'))
                                        echo '<tr style="background-color:red"><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td><input type="checkbox" name='.$row[4].' value = "utylizacja"></td></tr>';
                                    else
                                    {
                                        echo '<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td><input type="checkbox"  name='.$row[4].' value = "usuniecie"></td><td><input type="checkbox"  name=zazyj'.$row[5].' value = "zazycie"></td></tr>';
                                    }
                                }
                                echo '</table>';
                                echo '</div>';
                                echo '</form>';
                                echo '</div>';
                            }
                            $rezultaty->free_result();
                            $polaczenie->close();                           
                        }
                    }

                    catch(Exception $e)
                    {
                        echo $e->getMessage();
                        echo "Bląd połączenia z baza";
                    }

                    unset($_POST['apteczka']);
                    unset($_SESSION['po_usuwaniu']);
            } 
        ?>
</div>
    