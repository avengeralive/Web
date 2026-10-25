<?php if(!$ticket) { ?>
<h2>
    Нет данных по данному отправлению.
</h2>
<?php } else { ?>
<table>
    <tr class="first_tr">
        <td rowspan="2">
            Операция
        </td>
        <td width="1%" rowspan="2">
            Дата
        </td>
        <td width="1%" colspan="2">
            Место проведения операции
        </td>
        <td rowspan="2">
            Атрибут операции
        </td>
        <td width="1%" rowspan="2">
            Вес (кг.)
        </td>
        <td width="1%" rowspan="2">
            Объявл. ценность (руб.)
        </td>
        <td width="1%" rowspan="2">
            Налож. платёж (руб.)
        </td>
        <td colspan="2">
            Адресовано
        </td>
    </tr>
    <tr class="first_tr">
        <td>Индекс</td>
        <td>Название ОПС</td>
        <td>Индекс</td>
        <td>Адрес</td>
    </tr>
    <?php foreach($ticket as $value) { ?>
    <tr>
        <td>
            <?php echo $value['operation']['name']; ?>
        </td>
        <td>
            <?php echo date("d.m.Y H:i", $value['date']); ?>
        </td>
        <td>
            <?php echo $value['address']['index'] ? $value['address']['index'] : ""; ?>
        </td>
        <td>
            <?php echo $value['address']['name']; ?>
        </td>
        <td>
            <?php echo $value['operation']['attribute'] ? $value['operation']['attribute'] : ""; ?>
        </td>
        <td>
            <?php echo $value['weight'] ? $value['weight'] : "-"; ?>
        </td>
        <td>
            <?php echo $value['payment'] > 0 ? $value['payment']/100 : "-"; ?>
        </td>
        <td>
            <?php echo $value['price'] > 0 ? $value['price']/100 : "-"; ?>
        </td>
        <td>
            <?php echo $value['send']['index'] ? $value['send']['index'] : ""; ?>
        </td>
        <td>
            <?php echo $value['send']['name'] ? $value['send']['name'] : ""; ?>
        </td>
    </tr>
    <?php } ?>
</table>
<?php } ?>