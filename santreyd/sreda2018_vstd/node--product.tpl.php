<?php
$response = db_query("
    SELECT
        ft.field_type_tid AS tid
    FROM
        {field_data_field_type} AS ft
    WHERE
        ft.entity_type='commerce_product' AND
        ft.bundle='product' AND
        ft.entity_id=".$node->field_product[LANGUAGE_NONE][0]['product_id']."
");
$tid = 0;
foreach ($response as $row){
    $tid = $row->tid;
    break;
}
?>
<div id="node-<?=$node->nid?>" data-tid="<?=$tid?>" class="<?=$classes?> clearfix"<?=$attributes?>>

    <?=$user_picture?>
    
    <?=render($title_prefix)?>
    <? if (!$page): ?>
        <h2<?=$title_attributes?>><a href="<?=$node_url?>"><?=$title?></a></h2>
    <? endif; ?>
    <?=render($title_suffix)?>
    
    <? if ($display_submitted): ?>
        <div class="submitted"><?=$submitted?></div>
    <? endif; ?>

    <div class="content clear"<?=$content_attributes?>>
        <? hide($content['comments']); hide($content['links']); ?>
        <div class="contacts">
            <div class="title">Или позвоните нам:</div>
            <ul>
                <li>+7 (901) 710-14-53</li>                    
                <li>+7 (977) 971-13-16</li>
            </ul>
        </div>
        <?=render($content)?>
    </div>
    
    <?=render($content['links'])?>
    
    <?=render($content['comments'])?>
    
</div>