<form action="operacjeDB.php" method="post">
    <?php echo $lblIdFrmDU; ?>
    <input type="text" name="id" value="<?php echo $wiersz['id']; ?>" readonly><br>
    <?php echo $lblKodFrmDU; ?>
    <input type="text" name="kod" value="<?php echo $wiersz['kod']; ?>" required><br>
    <?php echo $lblAktorFrmDU; ?>
    <input type="text" name="aktor" value="<?php echo $wiersz['aktor']; ?>" required><br>
    <input type="hidden" name="kodOperacji" value="1021">
    <input type="submit" value="<?php echo $btFrmDU; ?>">
</form>