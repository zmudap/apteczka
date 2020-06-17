<?php
  $UPRselect = "SELECT * FROM uprawnienia WHERE login.id_kod=uprawnienia.id_kod";
  $UPRselect1 = "SELECT * FROM uprawnienia WHERE id = %d ORDER BY kod";

  $UPRselect2  = "SELECT id, NazwaHandlowa, Postac, KodKreskowy FROM ListaLekow 
                   WHERE  NazwaHandlowa LIKE '%%%s%%' AND KodKreskowy LIKE '%%%s%%'
                   AND Postac LIKE '%%%s%%' ORDER BY NazwaHandlowa LIMIT 50 OFFSET 0";

  $UPRinsert = "INSERT INTO uprawnienia (kod, aktor) VALUES (?, ?)";
  $UPRupdate = "UPDATE urawnienia SET kod=?, aktor=? WHERE id=?";
  $UPRdelete = "DELETE FROM uprawnienia WHERE id=?";

  $SLEKselect = "SELECT id, NazwaHandlowa, Postac, KodKreskowy FROM ListaLekow LIMIT 50 OFFSET 0";

  $LlEKwybor = "SELECT id, NazwaHandlowa, Postac, KodKreskowy FROM ListaLekow ";
  $LlEKwybor .= "WHERE NazwaHandlowa LIKE '%%%s%%' AND KodKreskowy LIKE '%%%s%%' ";
  $LlEKwybor .= "AND Postac LIKE '%%%s%%' ";
  $LlEKwybor .= "ORDER BY NazwaHandlowa LIMIT 50 OFFSET 0";

  $L1EKwybor = "SELECT id, NazwaHandlowa, Postac, KodKreskowy FROM ListaLekow WHERE  NazwaHandlowa LIKE '%%%s%%' AND KodKreskowy LIKE '%%%s%%' AND Postac LIKE '%%%s%%' ORDER BY NazwaHandlowa LIMIT 50 OFFSET %d";
?>