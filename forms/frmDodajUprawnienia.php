<form action="operacjeDB.php" method="post">
    <?php echo $lblKodFrmDU; ?>
    <input type="text" name="kod" placeholder="<?php echo $plhKodFrmDU; ?>" required><br>
    <?php echo $lblAktorFrmDU; ?>
    <input type="text" name="aktor" placeholder="<?php echo $plhAktorFrmDU; ?>" required><br>
    <input type="hidden" name="kodOperacji" value="103">
    <input type="submit" value="<?php echo $btFrmDU; ?>">
</form>