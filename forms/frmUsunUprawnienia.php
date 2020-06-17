<form action="operacjeDB.php" method="post">
    <?php echo $btFrmPytanieUU . $_GET['id'] . "dla aktora: " . $_GET['aktor']; ?>
    <input type="hidden" name="kodOperacji" value="104">
    <input type="hidden" name="id" value=" <?php $_GET['id'] ?> ">
    <input type="reset" value=" <?php echo $btFrmClear; ?> ">
    <input type="submit" value=" <?php echo $btFrmUU; ?> ">
</form>