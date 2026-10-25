
<link href="./templates/<?php echo $template; ?>/css/chat2.css" rel="stylesheet">  
<script language="JavaScript" type="text/javascript" src="https://comet-server.ru/CometServerApi.js" ></script>

<?php
    if((isset($user_id) && $user_login != '' && $phone_check == 1) or ($user_tip == 70 || $user_tip == 80 || $user_tip == 60  || $user_tip == 50)){

        $Chat_name = 'BDCPA';
        $comet = mysqli_connect("app.comet-server.ru","2173", "rJPckVXtb0fdY7KJN9ETFFsqNov6Oh8B2nqe01K8v3b2960fZTOjvPvlnPexmxL3", "CometQL_v1");
        $userCometHash =  md5("thisIsSaliblablaazazaza".$user_id."cpa");
        
        mysqli_query($comet, "INSERT INTO users_auth (id, hash)VALUES (".$user_id.", '".mysqli_real_escape_string($comet, $userCometHash)."')"); 
        mysqli_query($comet, "INSERT INTO pipes_messages (name, event, message)VALUES('track_" . $Chat_name . "', 'userLogin', '".mysqli_real_escape_string($comet,json_encode(Array( "name" => $user_login)))."')");

        $arr_us_online = [];
        
        $sqqlComet = mysqli_query($comet, "SELECT * FROM users_in_pipes WHERE name = 'track_" . $Chat_name . "'");
        while($OnlineUsers = $sqqlComet->fetch_array()){
            $arr_us_online[] = $OnlineUsers['user_id'];
        }
        //$arr_us_online = array_unique($arr_us_online);

        $chat_login = ($user_login == '') ? 'Аноним' : $user_login; 
        
        
    }else{
        ?>
        <div class="col-12 mt-30 mb-10 text-center">
            <div class="alert alert-danger" role="alert">
                Чтобы войти в чат необходимо указать логин в <a href="./profile.php">профиле</a> и подтвердить номер телефона.
            </div>
        </div>
        <?php
        return true;
    }

?>

<div id="frame">
    <div id="sidepanel" style="border: 1px solid #32465a;">
                <div id="search">
                    <p class="text-center mb-0 mt-0">Кто онлайн:</p>
		</div>

		<div id="contacts">
			<ul>
                            <?php
                            foreach ($arr_us_online as $k => $v) {
                                $u = User::getById($v);
                                if(!$u){continue;}
                                $ll = $u->login;
                                if($ll == ''){
                                    $ll = 'Аноним';
                                }
                            ?>
                            <li class="contact" data-user="<?=$ll; ?>">
                                <div class="wrap">
                                    <img src="<?=$u->avatar; ?>" alt="" />
                                    <div class="meta">
                                        <p class="name"><?=$ll; ?></p>
                                    </div>
                                </div>
                            </li> 
                            <?php 
                            }
                            ?>

			</ul>
		</div>
	</div>
    <div id="js-ajax-content" style="height: 100%;">
        
	<div class="content">           
            
		<div class="messages ">
                    <ul>

                    </ul>
		</div>
		<div class="message-input">
                    <div class="wrap">
                    <input type="text" id="mess" placeholder="Ваще сообщение..." />
                    <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
		</div>
	</div>
    </div>
</div>
    
<script >
$(".messages").animate({ scrollTop: $(document).height() }, "fast");

function newMessage() {
    var msg = $(".message-input #mess").val();
    var name = "<?=$chat_login; ?>";
    
    if($.trim(msg) == '') {
        return false;
    }
    
    $.ajax({
        url: './post/chat.php',
        type: 'POST',
        data: 'mode=send&mess='+msg,
    });


    var msgObj = {};
    msgObj.msgFrom = name;
    msgObj.msgMe = 'me';
    msgObj.msgText = msg;
    msgObj.userAva = "<?=$user_ava; ?>";
    msgObj.msgTime = 'dd.mm.yy';
    var m = makeMsg(msgObj);
    appendMessage(m);
    $('.message-input #mess').val(null);
    refreshChatScroll();
    CometServer().web_pipe_send("web_<?=$Chat_name; ?>", {"text":msg, "name":name, "ava":'<?=$user_ava; ?>'});

};

$('.submit').click(function() {
  newMessage();
});

$(window).on('keydown', function(e) {
  if (e.which == 13) {
    newMessage();
    return false;
  }
});

$(document).ready(function() {
    
    $('#js-ajax-content').css({
        opacity: 0.5
    });
    $('.chat-list').scrollTop($(this).height());
    CometServer().start({
        dev_id: 2173,
        user_id: <?=$user_id; ?>,
        user_key: "<?=$userCometHash; ?>"
    })
    CometServer().subscription("web_<?=$Chat_name; ?>", function(msg) {
        var msgObj = {}
        if(msg.server_info.user_id == <?=$user_id; ?>){
            msgObj.msgMe = 'me';
        }
        msgObj.msgFrom = msg.data.name;
        msgObj.msgText = msg.data.text;
        msgObj.userAva = msg.data.ava;
        msgObj.msgTime = 'dd.mm.yy';
        var m = makeMsg(msgObj);
        appendMessage(m);
        refreshChatScroll();
    });

    // Подписываемся на сообщения о входе людей в чат (отпраляются из php)
    CometServer().subscription("track_<?=$Chat_name; ?>.userLogin", function(msg)
    {

    });

    // Подписываемся на сообщения о выходе людей из чата (отпраляются из php)
    CometServer().subscription("track_<?=$Chat_name; ?>.userExit", function(msg)
    {

    });  

    CometServer().get_pipe_log("web_<?=$Chat_name; ?>");

    $('#js-ajax-content').css({
        opacity: 1
    });
    
});

</script>

<script type="text/javascript" src="./templates/<?php echo $template; ?>/js/chat.js"></script>