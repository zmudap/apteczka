<div class="container">
    <?php echo "<h4>Witaj ".$_SESSION['user']."!</h4>"?>
    <hr>



    <div class="dropdown" style = "display:inline-block">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="menu1Lista"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <?php echo "Baza leków i apteczek"?>
            </button>

            <div class="dropdown-menu" aria-labelledby="menu2lista">
                <a class="dropdown=item" href="index.php?operacja=201"><li><?php echo "Wyświetl bazę leków" ?></li></a>
                <a class="dropdown=item" href="index.php?operacja=202"><li><?php echo "Wyszukaj lek w bazie" ?></li></a>
                <a class="dropdown=item" href="index.php?operacja=203"><li><?php echo "Dodaj nową apteczkę" ?></li></a>
            </div>
    </div>
    <div class="dropdown" style = "display:inline-block">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="menu1Lista"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                <?php echo "Apteczka"?>
            </button>

            <div class="dropdown-menu" aria-labelledby="menu3lista">
                <a class="dropdown=item" href="index.php?operacja=302"><li><?php echo "Dodaj do apteczki" ?></li></a>
                <a class="dropdown=item" href="index.php?operacja=303"><li><?php echo "Historia apteczki" ?></li></a>
                <a class="dropdown=item" href="index.php?operacja=304"><li><?php echo "Zawartość apteczki" ?></li></a>
            </div>
            
            <input class="btn btn-danger" type="button" onClick="location.href='inc/logout.php'" value = "Wyloguj się">
            </input>
              
    </div>
        <hr> 
    </div>
</div>