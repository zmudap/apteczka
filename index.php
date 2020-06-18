<?php
  session_start();
  include "inc/nagl.php";
  include "inc/baza.php";
  include "inc/zapytania.php";
  include "lang/pl/txt.php";
  if(!isset($_SESSION['zalogowany']))
  {
    header('Location:inc/start.php');
    exit();
  }
?>

<div class="container">
  <h2><?php echo "Moja Apteczka Domowa" ?></h2>
</div>

<?php include "inc/menu1.php"; ?>

<div class="container">
<?php

  if(isset($_SESSION['zalogowany']) && isset($_GET['operacja']))
  {
    if(($mojePolaczenie = polaczenie()) == NULL)
    {
      echo $_SESSION['bladPolaczenia'];
    }
    $kodOperacji = $_GET['operacja'];

    function zapytanieDoBazy($polaczenie, $zapytanie)
    {
      if ($rezultat = $polaczenie->query($zapytanie))
      return $rezultat;
      else
      return NULL;
    }

    switch($kodOperacji)
    {

      case 201:
        if($wynik = zapytanieDoBazy($mojePolaczenie, $SLEKselect))
        {
          include "inc/naglTabSlowLekWysw.php";
          while($wiersz = $wynik->fetch_assoc())
            printf("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>", $wiersz['id'], $wiersz['NazwaHandlowa'], $wiersz['Postac'], $wiersz['KodKreskowy']);
            echo "</tbody></table>";
            $mojePolaczenie->close();
        }

        case 202: // Wyszukaj w słowniku
          if (!isset($_POST['nazwaH']) && ([!isset($_POST['kodKr'])])) 
          {
              echo "<h6>Uzupełnij pola, aby wyszukać lek</h6>";
              include "forms/frmSzukajWslownikuLek.php";
          } else 
          {
              $Offset = ($_GET['strona'] * 50) - 50;      // offset w zależności od strony
              $L1EKwybor = sprintf($L1EKwybor, $_POST['nazwaH'], $_POST['kodKr'], $_POST['Postac'], $Offset);
              echo "Zapytanie" . $L1EKwybor . " ";
              $mojePolaczenie->begin_transaction();   // rozpoczynamy transakcje
              if ($wynik = zapytanieDoBazy($mojePolaczenie, $L1EKwybor)) 
              {
                  $wierszy = $wynik->num_rows;
                  echo "<h5>Uzyskano $wierszy wiersz(e/y)</h5>";
                  include "inc/naglTabSlowLekWysw.php";     
                  // Wyświetlenie wybranych wierszy
                  while ($wiersz = $wynik->fetch_assoc()) {
                      $tabelaStrF = "<tr><td>%d</td><td>%s</td><td>%s</td><td>%s</td></tr>";
                      printf($tabelaStrF, $wiersz['id'], $wiersz['NazwaHandlowa'], $wiersz['Postac'], $wiersz['KodKreskowy']);
                  }
                  echo "</tbody></table>";

                  if ($wierszy == 50 && $wierszy > 0 && $_GET['strona'] == 1) {    // Tutaj jest przełączanie stron -- pierwsza strona z możliwością przełączenia
                      include "forms/frmSzukajWslownikuLekNastStrona.php";
                      $mojePolaczenie->commit();
                  } elseif ($wierszy == 50 && $wierszy > 0) {                    // kolejna strona z przełączeniami
                      include "forms/frmSzukajWslownikuLekPoprzStrona.php";
                      include "forms/frmSzukajWslownikuLekNastStrona.php";
                      $mojePolaczenie->commit();
                  } elseif ($wierszy != 50 && $wierszy > 0 && $_GET['strona'] != 1) {   // gdy użytkownik dotrze do ostatniej strony
                      echo "<h5>To jest ostatnia strona z wynikami wyszukiwania</h5>";
                      include "forms/frmSzukajWslownikuLekPoprzStrona.php";
                      $mojePolaczenie->commit();
                  } elseif ($wierszy > 0 && $_GET['strona'] == 1) { // gdy nie ma konieczonści przełączania się między stronami
                      echo "<h5>To wszystkie wyniki</h5>";
                      $mojePolaczenie->commit();
                  } elseif ($wierszy == 0 && $_GET['strona'] == 1) {                                      // gdy nie znaleziono żadnego wyniku
                      echo "<h4>Nie znaleziono leku spełniającego kryteria wyszukiwania</h4>";
                      $mojePolaczenie->commit();
                  } elseif ($wierszy == 0 && $_GET['strona'] != 1) {                                      // gdy nie znaleziono żadnego wyniku
                      echo "<h4>Nie ma więcej wyników wyszukiwania</h4>";
                      include "forms/frmSzukajWslownikuLekPoprzStrona.php";
                      $mojePolaczenie->commit();
                  }

                  $mojePolaczenie->close();
              }
            }
          break;
        

      case 203:
        
        include "inc/dodanieapteczki.php";
        $mojePolaczenie->close();
        
      break;

      case 302:
        
        include "inc/dodajlek.php";
        $mojePolaczenie->close();
        
      break;
      case 303:
        
        include "inc/historialeku.php";
        $mojePolaczenie->close();
        
      break;

      case 304:
        
        include "inc/zawartoscapteczki.php";
        $mojePolaczenie->close();
        
      break;
    }
  }
?>
</div>
<div class="container">

<?php
    include "inc/stopka.php";
?>