<option value="0">- Не выбрано -</option>
<?php foreach ($institutions as $key => $value): ?>
<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
<?php endforeach; ?>