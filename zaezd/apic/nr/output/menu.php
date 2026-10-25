<?php
if($_SESSION["user_type"]==1)
{
    echo '<p class="menu">';
    if(empty($global_mode)) echo '<a class="S" href="'.$base_url.'">Рассылки</a>';
    else echo '<a href="'.$base_url.'">Рассылки</a>';
    if($global_mode=="user") echo '<a class="S" href="'.$base_url.'user/">Пользователи</a> ';
    else echo '<a href="'.$base_url.'user/">Пользователи</a></li>';
    if($global_mode=="list") echo '<a class="S" href="'.$base_url.'list/">Списки адресатов</a> ';
    else echo '<a href="'.$base_url.'list/">Списки адресатов</a></li>';
    echo '</p><hr />';
}
if($_SESSION["user_type"]==2)
{
    echo '<p class="menu">';
    if(empty($global_mode)) echo '<a class="S" href="'.$base_url.'">Рассылки</a>';
    else echo '<a href="'.$base_url.'">Рассылки</a>';
    if($global_mode=="list") echo '<a class="S" href="'.$base_url.'list/">Списки адресатов</a> ';
    else echo '<a href="'.$base_url.'list/">Списки адресатов</a></li>';
    echo '</p><hr />';
}
?>
