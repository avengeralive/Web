<script src="//cdn.ckeditor.com/4.5.11/standard/ckeditor.js"></script>

<script src="/templates/<?php echo $template; ?>/modules/mailing/assets/js/jquery.form.js"></script>
<link rel="stylesheet" href="/templates/<?php echo $template; ?>/modules/mailing/assets/css/list.css"/>
<br><Br>
<style>

</style>
<p>
    <?php
    echo "<B>Статистика рассылки: " . $var_mailing->subject;
    ?></b>
</p>
<table width="100%">
    <Tr>
        <td width="80%" style="padding: 20px; background: white; border:2px dashed #ccc;">
            <?php echo $var_body; ?>
        </td>
        <Td valign="top" bgcolor="white" style="padding:20px" align="right">
            Открытий: <?php echo $var_mailing->opened; ?> <Br>
            Отписок: <?php echo $var_mailing->unsubscribe; ?> <Br>
            Всего кликов: <?php echo $var_mailing->clicks; ?> <Br>
        </td>
    </tr>
</table>
<script>
    $(function(){
        $('a[data-stat]').each( function(i,v){
            var stat = $(this).data('stat');
            $(this).append('<sup>'+stat+'</sup>');
        })
    })
</script>

