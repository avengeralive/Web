$(function() {
    $('.chat-list').scrollTop($(this).height());
    console.log($(this).height());
});


function appendMessage(msgTxt) {
   $( msgTxt ).appendTo($('.messages ul'));
}

function refreshChatScroll() {
    $(".messages").animate({ scrollTop: $(document).height() }, "fast");
    console.log($(document).height());
}

function strip(html) {
    var tmp = document.createElement("DIV");
    tmp.innerHTML = html;
    return tmp.textContent || tmp.innerText || "";
}
 
function makeMsg(msgObj) {
    if(msgObj.msgMe == 'me'){
        var m = '<li class="sent">';
    }else{
        var m = '<li class="replies">';
    }
    m += '<img src="'+msgObj.userAva+'" alt="" />';
    m += '<p><b>'+msgObj.msgFrom+'</b>:<br>'+msgObj.msgText+'</p>';
    m += "</li>";
    return (m);
}


$(document).on('blur', '.tbMessage', function () {
    var text = $(this).html();
    if(text == ''){
        $(this).html('Текст сообщения...');
    }
});

$(document).on('click', '.tbMessage', function () {
    var text = $(this).html();
    if(text == 'Текст сообщения...'){
        $(this).html('');
    }
});

$(document).on('click', '.smile', function () {
    var smile = $(this).attr('src');
    var text = $('.tbMessage').html();
    if(text == 'Текст сообщения...'){
        $('.tbMessage').html('');
    }
    $(".tbMessage").html($('.tbMessage').html() + ' <img src="'+smile+'" class="smile">');
});