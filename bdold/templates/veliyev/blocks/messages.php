
<link href="./templates/<?php echo $template; ?>/css/chat2.css" rel="stylesheet">  

<?php
$Messanger = new Messanger_Manager(DB::getInstance());
$getRequest = new Request($_GET);

function build_pagination_url($page = 1) {
    $parameters = array(
        'view' => ( isset($_GET['view']) ) ? $_GET['view'] : '',
    );
    return '?' . http_build_query($parameters);
}

if (isset($getRequest->view) && $getRequest->view != '') {
    $Messanger->where('id', $getRequest->view);
}

$Messanger->where("user_1 = $user_id or user_2 = $user_id",'', 6);
$result = $Messanger->get();

$support_name = 'support';
$support_id = 15;
$support_chat = 0;
?>

<div id="frame">
	<div id="sidepanel">

		<div id="contacts">
			<ul>

         
                                
                                <?php
                                if (is_array($result) && count($result) > 0) {

                                    foreach ($result as $res) {
                                        $c_m=0;
                                        $this_support = false;
                                        if($res->user_1 == $user_id){
                                            $u = User::getById($res->user_2);
                                        }elseif($res->user_2 == $user_id){
                                            $u = User::getById($res->user_1);
                                        }
                                        if($u->tip == 70 || $u->tip == 60 || $u->tip == 80){$this_support = true;}
                                        $c_m = Messanger::getCountNewChat($user_id,$res->id);
                                    ?>
                                        <li class="contact" data-user="<?=$u->id; ?>" data-id="<?=$res->id; ?>">
                                            <div class="wrap">
                                                <img src="<?=$u->avatar; ?>" alt="" />
                                                <div class="meta">
                                                    <p class="name"><?=$u->login; ?> <?php if($c_m > 0) { ?>&nbsp;&nbsp;&nbsp; <span class="badge badge-pill badge-primary"><?=$c_m; ?></span><?php } ?></p>
                                                </div>
                                            </div>
                                        </li>   
                                    <?php
                                    }
                                    if(!$this_support){
                                    ?>    
                                        <li class="contact" data-user="<?=$support_id; ?>" data-id="<?=$support_chat; ?>">
                                            <div class="wrap">
                                                <img src="./tmp/avatars/support.png" alt="" />
                                                <div class="meta">
                                                    <p class="name">Тех. поддержка</p>
                                                </div>
                                            </div>
                                        </li>   
                                    <?php            
                                    }
                                }else{
                                 ?>
                                        <li class="contact" data-user="<?=$support_id; ?>" data-id="<?=$support_chat; ?>">
                                            <div class="wrap">
                                                <img src="./tmp/avatars/support.png" alt="" />
                                                <div class="meta">
                                                    <p class="name">Тех. поддержка</p>
                                                </div>
                                            </div>
                                        </li>   
                                  <?php      
                                }
                                ?>

			</ul>
		</div>
		<div id="bottom-bar">
                    <button id="addcontact"><i class="fa fa-user-plus fa-fw" aria-hidden="true"></i> <span>Добавить контакт</span></button>
		</div>
                <div id="search" style="display:none;">
                    <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
                    <input type="text" id="search-input" placeholder="Поиск..." />
                    <button id="searchcontact"><span>Найти</span></button><button id="cancelsearch"><span>Отмена</span></button>
		</div>
	</div>
    <div id="js-ajax-content" style="    height: 100%;">
        
	<div class="content">
            
            <?php
            $new_contact = false;
            if (isset($getRequest->view) && $getRequest->view != '') {                
                $contact = User::getById($getRequest->user);
                $contact_ava = $contact->avatar;
                if($result && count($result) > 0){
                    $new_contact = true; 
                }
                ?>      
                    <div class="contact-profile" data-user="<?=$contact->id; ?>">
                        <img src="<?=$contact_ava; ?>" alt="" />
                        <p><?=$contact->login; ?></p>
                    </div>
            <?php    
            }else{
            ?>
		<div class="contact-profile">
                    <p class="text-center" style="float:none;">Выберите собеседника из списка контактов</p>
		</div>
            <?php
            }
            ?>
            

            
            
                            
            <div class="messages ">
                                <ul>
                    <?php
                    if ($new_contact) {
                        $chat_id = $result[0]->id;
                        
                        $m = Messanger::getById($chat_id);
                        if($m->user_1 == $user_id){
                            $m->update(['status_us1' => 0]);
                        }else{
                            $m->update(['status_us2' => 0]);
                        }
                        
                        $messages = Messanger_Messages::getByChat($chat_id);
                        foreach ($messages as $msg) {
                            
                            if($msg->user_id == $user_id){
                                $cl = 'sent';
                                $ava = $user_ava;
                            }else{
                                $cl = 'replies';
                                $ava = $contact_ava;
                            }
                            
                        ?>
				<li class="<?=$cl; ?>">
                                    <img src="<?=$ava; ?>" alt="" />
                                    <p><?=$msg->message; ?></p>
				</li>
                        <?php
                        }
                    }else{
                    ?>
                        
                    <?php    
                    }
                    ?>
                                </ul>
                    <!--
			<ul>
                            
				<li class="sent">
					<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
					<p>How the hell am I supposed to get a jury to believe you when I am not even sure that I do?!</p>
				</li>
				<li class="replies">
					<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
					<p>When you're backed against the wall, break the god damn thing down.</p>
				</li>
				<li class="replies">
					<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
					<p>Excuses don't win championships.</p>
				</li>
				<li class="sent">
					<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
					<p>Oh yeah, did Michael Jordan tell you that?</p>
				</li>
				<li class="replies">
					<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
					<p>No, I told him that.</p>
				</li>
				<li class="replies">
					<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
					<p>What are your choices when someone puts a gun to your head?</p>
				</li>
				<li class="sent">
					<img src="http://emilcarlsson.se/assets/mikeross.png" alt="" />
					<p>What are you talking about? You do what they say or they shoot you.</p>
				</li>
				<li class="replies">
					<img src="http://emilcarlsson.se/assets/harveyspecter.png" alt="" />
					<p>Wrong. You take the gun, or you pull out a bigger one. Or, you call their bluff. Or, you do any one of a hundred and forty six other things.</p>
				</li>
                                
			</ul>
                     -->
		</div>
		<div class="message-input">
                    <div class="wrap">
                    <input type="text" id="mess" placeholder="Ваще сообщение..." />
                    <input type="hidden" id="chat_id" value="<?=$getRequest->view; ?>">
                    <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                    </div>
		</div>
	</div>
    </div>
</div>
    
<script >
$(".messages").animate({ scrollTop: $(document).height() }, "fast");

$(document).on('click', '.submit', function () {
    var message = $(".message-input #mess").val();
    
    if($.trim(message) == '') {
        return false;
    }
    
    var user_to = $('.contact-profile').attr('data-user');
    var chat_id = $('#chat_id').val();
    
    $('<li class="sent"><img src="<?=$user_ava; ?>" alt="" /><p>' + message + '</p></li>').appendTo($('.messages ul'));
    $('.message-input #mess').val(null);
    $(".messages").animate({ scrollTop: $(document).height() }, "fast");
    
    $.ajax({
        url: './post/chat.php',
        type: 'POST',
        data: 'mode=write&message='+message+'&chat='+chat_id+'&user_to='+user_to,
        success: function (response) {
            data = jQuery.parseJSON(response);
            $('#chat_id').val(data.chatId);
            $('.contact.active').attr('data-id', data.chatId);
            
        }
    });
});


$(window).on('keydown', function(e) {
  if (e.which == 13) {
    newMessage();
    return false;
  }
});

$(document).on('click', '.contact', function () {
    $('.contact').removeClass('active');
    $(this).addClass('active');
    var id = $(this).attr('data-id');
    var user = $(this).attr('data-user');
    $('#chat_id').val(id);
    loadTable('?view=' + id + '&user='+user);
    return false;
});

    function loadTable(req) {
        $('#js-ajax-content').css({
            opacity: 0.5
        });
        $('#js-ajax-content').load(req + ' #js-ajax-content', function () {
            $('#js-ajax-content').css({
                opacity: 1
            });
        });
    }

$(document).on('click', '#addcontact', function () {
    $('#search').show();
    $(this).hide();
});

$(document).on('click', '#cancelsearch', function () {
    $('#search').hide();
    $('#addcontact').show();
    $("#contacts ul li").show();
});

$(document).on('click', '#searchcontact', function () {
    var search = $("#search-input").val();
    if(search && search.length > 0) {
        $.ajax({
            url: './post/searchContacts.php',
            type: 'POST',
            data: 'search='+search,
            success: function (response) {
                data = jQuery.parseJSON(response);
                if(data.status == 'success'){
                    $("#contacts ul li").hide();
                    
                    $(data.message).each(function() {
                        var li =  $('<li class="contact"  data-id="0" data-user="'+this.id+'"> ');
                        var div =  $('<div class="wrap">');
                        var ava = $('<img src="'+this.avatar+'" alt="" />');
                        var meta = $('<div class="meta">');
                        var name = $('<p class="name">'+this.login+'</p>');
                        var preview = $('<p class="preview"></p>');
                        
                        meta.append(name);
                        meta.append(preview);
                        div.append(ava);
                        div.append(meta);
                        li.append(div);
                        $("#contacts ul").append(li);
                        
                    });
                    
                }else{
                    new Noty({
                        text: data.message,
                        type: data.status,
                        theme: 'nest',
                        timeout: 3000,
                        closeWith: ['click', 'button'],
                        layout: 'topRight'
                    }).show();
                }
            }
        });
    }
});

</script>