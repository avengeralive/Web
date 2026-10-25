<?php

if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'visible' && ($user_tip == '70' || $user_tip == '80' || $user_tip == '90')) {
    $offer = Offer::getById($_REQUEST['offer']);
    if (isset($_REQUEST['action2'])) {
        foreach($_REQUEST['comission'] as $key => $val){
            $sql = 'update offers_visible set comission="'.$val.'", comission_cpa="'.$_REQUEST['comission_cpa'][$key].'" where offer_id = '.intval($_REQUEST['offer']).' and user_id = '.$key;
            DB::getInstance()->query($sql);
        }
    }
    if (isset($_REQUEST['data'])) {
        // обновить
        foreach($_REQUEST['data'] as $id){
            $sql = "insert into offers_visible set offer_id=".intval($_REQUEST['offer']).', comission = "'.$offer->comission.'", comission_cpa = "'.$offer->comission_cpa.'", user_id='.intval($id).' on duplicate key update user_id=user_id';
            DB::getInstance()->query($sql);
        }
        
    }
    if(isset($_REQUEST['del'])){
        $sql = "delete from offers_visible where offer_id=".intval($_REQUEST['offer'])." and user_id=".intval($_REQUEST['del']);
        DB::getInstance()->query($sql);
        
    }
    $offer = Offer::getById($_REQUEST['offer']);
    
    if(!$offer){
        exit;
    }
    if( $offer->uroven_dostupa!='-1'){
        echo "<img src='https://pp.vk.me/c413831/v413831785/4565/ByXSNVyWuvo.jpg'>";
        exit;
    }
    
    $users = $offer->getVipUsers();
    echo '<html><link rel=stylesheet href=https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css><script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';;
    
    echo "<center><h4>Текущие пользователи</h4>";
    echo "<form action=? method=post><input type=hidden name=offer value={$_REQUEST['offer']}> <input type=hidden name=action value=visible> <input type=hidden name=action2 value=upd> <table class='table table-bordered table-stripped table-hover' >";
    if( count($users)==0){
        echo "<tr><td>ВИП нет</td></tr>";
    }
    else{
        foreach($users as $row){
            //echo "<Tr><td>{$row->email} </td><td width=30><a href=/offers.php?offer={$_REQUEST['offer']}&action=visible&del={$row->id} onclick=\"return confirm('Удалить?')\" title='Удалить' class='btn btn-sm btn-danger'>&mdash;</a> </tr>";
            $sql = "select * FROM offers_visible where offer_id=".intval($_REQUEST['offer'])." and user_id=".intval($row->id);
            $x = DB::getInstance()->query($sql);
            $y = $x->fetchAll()[0];
            echo "<Tr><td>{$row->email} </td><td>Выплата вебмастеру<br><input type='text' name='comission[{$row->id}]' placeholder='Выплата вебмастеру' value='".$y['comission']."'></td><td>Комиссия CPA<br><input type='text' name='comission_cpa[{$row->id}]' placeholder='Комиссия CPA' value='".$y['comission_cpa']."'></td><td width=30><a href=/offers.php?offer={$_REQUEST['offer']}&action=visible&del={$row->id} onclick=\"return confirm('Удалить?')\" title='Удалить' class='btn btn-sm btn-danger'>&mdash;</a> </tr>";
        }
    }
    echo "</table><input type=submit class='btn btn-success' value=Сохранить> <br><br></form>"
    . "<h4>Добавить новых</h4>"
            . "<code>Выберите галочками новых пользователей <br>и нажмите сохранить</code><hr><input type=text placeholder=Поиск id=search class=form-control><hr>"
            . "<form action=? method=post><input type=hidden name=offer value={$_REQUEST['offer']}> <input type=hidden name=action value=visible> <table class='table table-bordered table-hover'>"
            . "";
    $um = new Users_Manager(DB::getInstance());
    $um->where('tip', 10);
    $um->where('active', 1);
    $um->limit(-1);
    $list = $um->get();
    foreach($list as $row){
        echo "<tr class=t><td class=d>{$row->email}</td><td width=20><input type=checkbox name=data[] value={$row->id}></td></tr>";
    }
            
    echo '</table> <input type=submit class="btn btn-success" value=Сохранить style="position: fixed; bottom: 10px; left: 150px"> <br><br><br><br>';
    echo "<script>"
    . "$(function(){"
            . "$('#search').on('keyup', function(){"
            
                . " var v=$(this).val();"
                . " $('.t').show();"
                . " $('.d').each( function(){ "
            . "         if( $(this).text().indexOf(v)==-1) { "
            . "             $(this).parent().hide();"
            . "         }"
            . "     })"
            . "     });"
            
            . "});</script>";
    exit;
}