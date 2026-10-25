<?php
  echo "<H2>".$title."</H2>";
	
  echo '<form action="/admin-member/'.$folder.'index.php?mode=sect&smode='.$smode.'_f&parent='.$parent.'&id_s='.$id_s.'" method="post" enctype="multipart/form-data" name="form1">'."\n";
  echo '<tr>'."\n";
  echo '<td width="15%">'."\n";
  echo "Название";
  echo '</td>'."\n";
  echo '<td>'."\n";
  echo '<input name="name" type="text" id="name" width="100" value="'.$name.'">'."\n";
  echo '</td>'."\n";
  echo '</tr>'."\n";

  echo '<td width="15%">'."\n";
  echo "Название (англ)";
  echo '</td>'."\n";
  echo '<td>'."\n";
  echo '<input name="name_en" type="text" id="name_en" width="100" value="'.$name_en.'">'."\n";
  echo '</td>'."\n";
  echo '</tr>'."\n";
  
  echo '<tr>'."\n";
  echo '<td width="15%">'."\n";
  echo "Буквенный ай-ди";
  echo '</td>'."\n";
  echo '<td>'."\n";
  echo '<input name="sid" type="text" id="sid" width="100" value="'.$sid.'">'."\n";
  echo '</td>'."\n";
  echo '</tr>'."\n";
  
  echo '<tr>'."\n";
  echo '<td>'."\n";
  echo '<input type="submit" name="Submit" value="Принять">'."\n";
  echo '</td>'."\n";
  echo '</tr>'."\n";

  echo '</form>'; 
?>