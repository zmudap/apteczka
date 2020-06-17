<?php
    session_start();
    if(!isset($_SESSION['zalogowany']))
    {
        header('Location:start.php');
        exit();
    }

    $zalogowany = $_SESSION['zalogowany'];
    $id_apteczki = $_SESSION['id_apteczki'];
    require_once 'connect.php';

    try
    {  
        $polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
        if($polaczenie->connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {        
            $rezultaty = $polaczenie->query("SELECT ListaLekow.id_leku, leki_w_apteczkach.koszt, leki_w_apteczkach.id_leku_w_apteczce, leki_w_apteczkach.data_waznosci FROM ListaLekow, leki_w_apteczkach WHERE ListaLekow.id=leki_w_apteczkach.id_leku AND leki_w_apteczkach.id_apteczki=$id_apteczki");
            $data = date('Y-m-d H:i:s');
            echo $_POST['action'];
            if($_POST['action'] == 'Usun/Utylizuj')
            {
                while($row = $rezultaty->fetch_row())
                {
                    if(isset($_POST[$row[4]]))
                    {
                        $nazwa_operacji = $_POST[$row[4]];
                        $id_lek = $row[0];
                        $ilosc_opakowan = 1;
                        $koszty = $row[1];
                        echo $nazwa_operacji.' '.$id_lek.' '.$zalogowany.' '.$id_apteczki.' '.$data.'<br>';
                        $polaczenie->query("INSERT INTO Operacje_w_apteczkach VALUES (NULL,'$nazwa_operacji','$id_lek','$id_apteczki','$ilosc_opakowan', '$data', '$zalogowany')");
                        $polaczenie->query('DELETE FROM leki_w_apteczkach WHERE id_leku_w_apteczce='.$row[4]);
                    }
                }
            }
            else
            {
                echo 'test';
                while($row = $rezultaty->fetch_row())
                {
                    if(isset($_POST['zazyj'.$row[5]]))
                    {
                        $nazwa_operacji = $_POST['zazyj'.$row[5]];
                        $id_lek = $row[0];
                        $ilosc_opakowan = 1;
                        $koszty = $row[1];
                        echo $nazwa_operacji.' '.$id_lek.' '.$zalogowany.' '.$id_apteczki.' '.$data.'<br>';
                        $polaczenie->query("INSERT INTO Operacje_w_apteczkach VALUES (NULL,'$nazwa_operacji','$id_lek','$id_apteczki','$ilosc_opakowan', '$data', '$zalogowany')");
                        $polaczenie->query('DELETE FROM leki_w_apteczkach WHERE id_leku_w_apteczce='.$row[5]);
                    }
                }
            }
            $polaczenie->close(); 
            $_SESSION['po_usuwaniu'] = $id_apteczki;
            header('location: zawartoscapteczki.php');
        }

    }
    catch(Exception $e)
    {
        echo "blad polaczenia z baza";
    }
?>