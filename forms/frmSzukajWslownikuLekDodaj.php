<form action="index.php?operacja=302&strona=1" method="post">
    <?php echo "Nazwa leku"; ?>
    <input type="text" name="nazwaH" placeholder="podaj nazwę leku" required><br>
    <?php echo "Postać leku"; ?>
    <input type="text" name="Postac" placeholder="podaj fragment postaci" ><br>
    <?php echo "Kod kreskowy" ?>
    <input type="text" name="kodKr" placeholder="podaj fragment kodu" ><br>
    <input type="hidden" name="kodOperacji" value="302">
    <input type="submit" value="<?php echo $btFrmSearch; ?>">
</form>
