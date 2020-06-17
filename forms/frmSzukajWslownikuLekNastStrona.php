<div style="float:right;">
<form action="index.php?operacja=202&strona=<?php echo ($_GET['strona'] + 1)?>" method="post">
    <input type="hidden" name="nazwaH" value="<?php echo  $_POST['nazwaH'] ?>">
    <input type="hidden" name="Postac" value="<?php echo  $_POST['kodKr'] ?>">
    <input type="hidden" name="kodKr" value="<?php echo  $_POST['Postac'] ?>">
    <input type="submit" value="<?php echo "Następna strona" ?>" class="btn btn-success">
</form>
</div>
