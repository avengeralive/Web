<?php
  echo "<H2>".$title."</H2>";
	
  echo '<form action="/admin-member/'.$folder.'index.php?mode=obj&smode='.$smode.'_f&id_so='.$id_so.'" method="post" enctype="multipart/form-data" name="form1">'."\n";
  echo '<tr>'."\n";
  echo '<td width="15%">'."\n";
  echo "Название";
  echo '</td>'."\n";
  echo '<td>'."\n";
  echo '<input name="name" type="text" id="name" width="100" value="'.$name.'">'."\n";
  echo '</td>'."\n";
  echo '</tr>'."\n";
 
  echo '<tr>'."\n";
  echo '<td>'."\n";
  echo '<input type="submit" name="Submit" value="Принять">'."\n";
  echo '</td>'."\n";
  echo '</tr>'."\n";

  echo '</form>'; 
?>