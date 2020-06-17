<?php
  include "inc/zapytania.php";
  function polaczenie()
  {
    global $txtBladPolaczenia;
    $host = "mysql.agh.edu.pl";
    $db_user = "zmuda";
    $db_password = "wpDwW8peD4a7haHg";
    $db_name = "zmuda";

    if(isset($_SESSION['bladPolaczenia'])) unset($_SESSION['bladPolaczenia']);
    $polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);

    if($polaczenie->connect_errno != 0)
    {
      $_SESSION['bladPolaczenia'] = $txtBladPolaczenia . $polaczenie->connect_error;     
      return NULL;
    }
    else 
    {
      $polaczenie->set_charset("utf8"); //Tutaj wzialem kodoawnie polskich znakow zad02_01 3str
      return $polaczenie;
    }
  }

    //$txtBladPolaczenia = "Wystąpił błąd połączenia: ";
    $txtBladZapytania = "Błąd zapytania";

  
?>