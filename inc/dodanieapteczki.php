<?php
    if(!isset($_SESSION['zalogowany']))
    {
        $_SESSION['bladLogowania'] = "Najpierw sie zaloguj ;)";
        header('Location: index.php');
        exit();
    }
    $zalogowany = $_SESSION['zalogowany'];


    
    if(isset($_POST['kit'])){
        $nazwa = $_POST['kit'];


        require_once "connect.php";
        mysqli_report(MYSQLI_REPORT_STRICT);
        try{
            $polaczenie = new mysqli($host, $db_user,$db_password, $db_name);
            if($polaczenie->connect_errno!=0){
                throw new Exception(mysqli_connect_errno());
            }
            else{
 
                $polaczenie->query("INSERT INTO apteczki VALUES (NULL,'$nazwa')");
                
                
                $polaczenie->close();
            }
        }
        catch(Exception $e){
            echo "Błąd serwera! Przepraszamy za niedogodności i prosimy o rejsetracje w innym terminie";
            echo '<br>Bład'.$e;
        }

        unset($_POST['kit']);
    }




?>

<div class = "container">
    <div class = "row">
        <form method="post">
            <div class = "form-group row">
                <div class = "form-group col-md-8">
                    <input  class="form-control" type="text" placeholder = "Tu wpisz nazwę apteczki" name = "kit">
                </div>
                <div class = "form-group col-md-4">
                    <button  class="btn btn-primary" type="submit" >Stwórz apteczkę!</button>
                </div>
            </div>
        </form>
    </div>
</div>

