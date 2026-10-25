var path = '/adminion/index.php';
function load(){
	header();
	$('#menu').load(path+'?mod=menu');
	$('#context').load(path+'?mod=context');
	$( "#loading" ).fadeOut('slow');
}
function header(){
	$('#header').load(path+'?mod=header');
}
function lC(menu){
	$('#context').fadeOut('slow', function(){
		$('#context').load(path+'?mod=context&menu='+menu, function(){
			$('#context').fadeIn('slow');
		});
	});
}
function hideShow(element_id){
	if (document.getElementById(element_id)){
		var obj = document.getElementById(element_id); 
		if (obj.style.display != "block"){ 
			obj.style.display = "block"; 
		}
		else{
			obj.style.display = "none";
		}			
	}
	else alert("Ёлемент с id: " + element_id + " не найден!"); 
}

function loadWorks(type){
	$('#workList').html('Loading...');
	$('#workList').load(path+'?mod=context&menu=workList&action=showWorks&type='+type);
}
function workDelEffect(id){
    $("#work_"+id).fadeOut(300, function() {
        $(this).remove();
    });
}
function workDel(id){
	$('#workMsg').load('?mod=context&menu=workList&action=delWork&id='+id);
	$( "#dialog" ).dialog( "close" );
}
function workTikOpen(id){
	$('#workMsg').load('?mod=context&menu=workList&action=openWork&id='+id);
	$( "#dialog" ).dialog( "close" );
}
function workTikDel(id){
	$('#workMsg').load('?mod=context&menu=workList&action=delWork2&id='+id);
	$( "#dialog" ).dialog( "close" );
}
function workTikSave(id){
	var txt = $("#WorkiText").val();
	$('#workMsg').load('?mod=context&menu=workList&action=saveWork&id='+id+'&text='+txt);
	$( "#dialog" ).dialog( "close" );
}
function selShop(id){
	$('#getRazdel').load('?mod=context&menu=shopEditor&action=getRazdel&id='+id);
}
function selShopRazCont(selShop,id){
	$('#razdelContent').load('?mod=context&menu=shopEditor&action=selShopRazCont&id='+id+'&selShop='+selShop);
}
function saveItm(its_id,itm_id){
	var colvo = $("#itm_"+its_id+"_x").val();
	
	var priceShopKr = $("#itm_"+its_id+"_p1").val();
	var priceShopEkr = $("#itm_"+its_id+"_p2").val();
	
	var priceMainKr = $("#itm_"+itm_id+"_b1").val();
	var priceMainEkr = $("#itm_"+itm_id+"_b2").val();
	
	var prtr = $("#itm_"+its_id+"_trres").val();

	var sid = $("#shop_id").val();
	

	$.ajax({
		url: "?mod=context&menu=shopEditor&action=saveItm",
		type: "POST",
		data: "its_id="+its_id+"&itm_id="+itm_id+"&itm_"+its_id+"_x="+colvo+"&itm_"+its_id+"_p1="+priceShopKr+"&itm_"+its_id+"_p2="+priceShopEkr+"&itm_"+itm_id+"_b1="+priceMainKr+"&itm_"+itm_id+"_b2="+priceMainEkr+"&sid="+sid+"&prtr="+prtr+"", 
		success: function(data){
			$("#workMsg_"+its_id+itm_id).html(data);
		}
	});
}
function delItmShop(its_id,itm_id){
	var sid = $("#shop_id").val();
	$.ajax({
		url: "?mod=context&menu=shopEditor&action=delItmShop",
		type: "POST",
		data: "id="+its_id+"&sid="+sid+"", 
		success: function(data){
			$("#workMsg_"+its_id+itm_id).html(data);
			$("#item_"+its_id+itm_id).hide();
		}
	});
}
function shopItems(id){
	$('#shopThings').html('Loading...');
	$('#shopThings').load(path+'?mod=context&menu=test&action=showItems&id='+id);
}


function checkAlch(login){
	login = encodeURI(login);
	$.ajax({
		url: "?mod=context&menu=alchBank&action=alchLogin",
		type: "POST",
		data: "alchLogin="+login, 
		success: function(data){
			$("#alchResult").html(data);
		}
	});
}
function alchLoadCreate(uid){
	$('#alchCreate').load('?mod=context&menu=alchBank&action=alchLoadCreate&uid='+uid);
}

function alchEditLoad(id){
	$('#alchEdit').load('?mod=context&menu=alchBank&action=alchEditLoad&id='+id);
}
function alchSave(id){
	var procent = $("#alchDiscount").val();
	$.ajax({
		url: "?mod=context&menu=alchBank&action=alchEditSave&id="+id,
		type: "POST",
		data: "procent="+procent, 
		success: function(data){
			$("#alchSaveStatus").html(data);
		}
	});
}
function alchOrdersLoad(){
	$('#alchOrders').html('Loading...');
	$('#alchOrders').load('?mod=context&menu=alchBank&action=alchOrdersLoad');
}
function alchSetOrderStatus(id,stat){
	$('#setOrderStatus').load('?mod=context&menu=alchBank&action=alchSetOrderStatus&id='+id+'&status='+stat);
}
function alchDisableSelect(id){
	$("#orderStatus_"+id).prop('disabled', 'disabled');
}

function salesSearch(){
	var searchFrom = $("#datetimepicker").val();
	var searchTo = $("#datetimepicker2").val();

	var searchBank = 0;
	var searchAlh = 0;

	if ($('#list_bank').is(':checked')) {
		searchBank = 1;
	}
	if ($('#list_alh').is(':checked')) {
		searchAlh = 1;
	}	

	$('#salesList').load('?mod=context&menu=sales&action=salesSearch&from='+searchFrom+'&to='+searchTo+'&bank='+searchBank+'&alh='+searchAlh+'');
}

function roomsLoad(){
	$('#room_list').load('?mod=context&menu=roomEditor&action=loadRooms');
}
function roomsSave(id){

	
	var nname = $("input[name=nname]").val();
	var ncity = $("select[name=ncity]").val();
	var ncode = $("input[name=ncode]").val();
	var ntimeGO = $("input[name=ntimeGO]").val();
	var nfile = $("input[name=nfile]").val();
	var nlevel = $("input[name=nlevel]").val();
	var nalign = $("input[name=nalign]").val();
	var nclan = $("select[name=nclan]").val();
	var ndestroy = $("select[name=ndestroy]").val();
	var nclose = $("select[name=nclose]").val();
	var nroomGo = $("textarea[name=nroomGo]").val();
	var nsex = $("select[name=nsex]").val();
	
	
	
 	 $.ajax({
		url: "?mod=context&menu=roomEditor&action=roomsSave",
		type: "POST",
		data: "nid="+id+"&nname="+nname+"&ncity="+ncity+"&ncode="+ncode+"&ntimeGO="+ntimeGO+"&nfile="+nfile+"&nlevel="+nlevel+"&nalign="+nalign+"&nclan="+nclan+"&ndestroy="+ndestroy+"&nclose="+nclose+"&nroomGo="+nroomGo+"&nsex="+nsex+"",
		beforeSend: function(){
			$('#saveStatus').text('Сохранение...');
		},
		success: function(data){
			$("#saveStatus").html(data);
		}
	});
}
function roomDelete(id){
	if (confirm("Yдалить локацию?")) {
		$.post( "?mod=context&menu=roomEditor&action=roomsDel", { id: id } );
		lC('roomEditor');
	}	
}
function roomsAdd(id){

	
	var nname = $("input[name=nname]").val();
	var ncity = $("select[name=ncity]").val();
	var ncode = $("input[name=ncode]").val();
	var ntimeGO = $("input[name=ntimeGO]").val();
	var nfile = $("input[name=nfile]").val();
	var nlevel = $("input[name=nlevel]").val();
	var nalign = $("input[name=nalign]").val();
	var nclan = $("select[name=nclan]").val();
	var ndestroy = $("select[name=ndestroy]").val();
	var nclose = $("select[name=nclose]").val();
	var nroomGo = $("textarea[name=nroomGo]").val();
	var nsex = $("select[name=nsex]").val();
	
	
	
 	 $.ajax({
		url: "?mod=context&menu=roomEditor&action=roomsAdd",
		type: "POST",
		data: "nname="+nname+"&ncity="+ncity+"&ncode="+ncode+"&ntimeGO="+ntimeGO+"&nfile="+nfile+"&nlevel="+nlevel+"&nalign="+nalign+"&nclan="+nclan+"&ndestroy="+ndestroy+"&nclose="+nclose+"&nroomGo="+nroomGo+"&nsex="+nsex+"",
		beforeSend: function(){
			$('#saveStatus').text('Cохранение...');
		},
		success: function(data){
			$("#saveStatus").html(data);
		}
	});
}

function moderLogSearch(){
	var searchFrom = $("#datetimepicker").val();
	var searchTo = $("#datetimepicker2").val();

	var searchTar = 0;
	var searchPal = 0;
	var searchAdm = 0;

	if ($('#list_tar').is(':checked')) {
		searchTar = 1;
	}
	if ($('#list_pal').is(':checked')) {
		searchPal = 1;
	}
	if ($('#list_adm').is(':checked')) {
		searchAdm = 1;
	}
	$('#moderList').load('?mod=context&menu=moderLogs&action=showlogs&from='+searchFrom+'&to='+searchTo+'&tar='+searchTar+'&pal='+searchPal+'&adm='+searchAdm+'');
}

function shopEditorSearchId(itId){
	var sid = $("#sId").val();
	$('#sResult').load('?mod=context&menu=shopEditor&action=sItemId&sId='+sid+'&itId='+itId+'');
}
function shopEditorSearchName(itId){
	var sName = $("#sName").val();
	name = encodeURI(sName);
	$('#sResult').load('?mod=context&menu=shopEditor&action=sItemName&sName='+name+'&itId='+itId+'');
}
function shopAddRes(id,where){
	var kolvo = $("#kolvo_"+where+"_"+id+"").val();
	var trres = $("#itm_"+where+"_trres").val();
	var nname = trres+''+id+'='+kolvo+',';
	$("#itm_"+where+"_trres").val(nname);
}






function botEditorDng(){
	var id = $("#dnId").val();
	$.ajax({
		url: "?mod=context&menu=botEditor&action=loadBots",
		type: "GET",
		data: "did="+id,
		beforeSend: function(){
			$('#botList').text('Loading...');
		},
		success: function(data){
			$("#botList").html(data);
		}
	});
}
function botEditorSave(id){
	var bId = $("#bId").val();
	var bGroup = $("#bGroup").val();
	var bCount = $("#bCount").val();
	var bMove = $("#bMove").val();
	var bX = $("#bX").val();
	var bY = $("#bY").val();
	//-------------------
	var bLogin = $("#bLogin").val();
	var bObraz = $("#bObraz").val();
	var bLevel = $("#bLevel").val();
	var bSex = $("#bSex").val();
	var bName = $("#bName").val();
	var bAgressor = $("#bAgressor").val();
	var bExpB = $("#bExpB").val();
	var bStats = $("#bStats").val();
	var bItemsUse = $("#bItemsUse").val();
	var bP_items = $("#bP_items").val();
	
	$.ajax({
		url: "?mod=context&menu=botEditor&action=saveBots",
		type: "GET",
		data: "id="+id+"&bGroup="+bGroup+"&bCount="+bCount+"&bMove="+bMove+"&bId="+bId+"&bX="+bX+"&bY="+bY+"&bLogin="+bLogin+"&bObraz="+bObraz+"&bLevel="+bLevel+"&bSex="+bSex+"&bName="+bName+"bAgressor="+bAgressor+"&bExpB="+bExpB+"bStats="+bStats+"&bItemsUse="+bItemsUse+"&bP_items="+bP_items+"",
		beforeSend: function(){
			$('#saveStatus').text('Loading...');
		},
		success: function(data){
			$("#saveStatus").html(data);
		}
	});
}
function botEditorDelete(id,did){
	if (confirm("Yдалить бота?")) {
		$.post( "?mod=context&menu=botEditor&action=delBots", { id: id } );
		$.ajax({
			url: "?mod=context&menu=botEditor&action=loadBots",
			type: "GET",
			data: "did="+did,
			beforeSend: function(){
				$('#botList').text('Loading...');
			},
			success: function(data){
				$("#botList").html(data);
			}
		});
	}	
}
function botEditorAddStats(){
	var bStats = $("#bStats").val();
	var spar = $("#spar").val();
	var sparid = $("#sparid").val();
	var nname = bStats+''+spar+'='+sparid+'|';
	$("#bStats").val(nname);
}

function newEditorLoadNews(){
	$('#newsList').load('?mod=context&menu=newsEditor&action=loadNews');
}
function newEditorSaveNews(id)
{
	var newsTitle = $("#newsTitle").val();
	var newsText = CKEDITOR.instances.newsText.getData();
		$.ajax({
			url: "?mod=context&menu=newsEditor&action=saveNews&id="+id,
			type: "POST",
			data: "title="+newsTitle+"&text="+newsText,
			beforeSend: function(){
				$('#saveStatus').text('Cохранение...');
				
			},
			success: function(data){
				$("#saveStatus").html(data);
				newEditorLoadNews();
			}
		});
}
function newEditorDelete(id){
	if (confirm("Yдалить новость?")) {
		$.ajax({
			url: "?mod=context&menu=newsEditor&action=delNews",
			type: "GET",
			data: "id="+id,
			success: function(data){
				newEditorLoadNews();
			}
		});
	}
}
function newEditorAddNews(){
	var newsTitle = $("#newsTitle").val();
	var newsText = CKEDITOR.instances.newsText.getData();
		$.ajax({
			url: "?mod=context&menu=newsEditor&action=addNewsSave",
			type: "POST",
			data: "title="+newsTitle+"&text="+newsText,
			beforeSend: function(){
				$('#saveStatus').text('Saving...');
			},
			success: function(data){
				$("#saveStatus").html(data);
				newEditorLoadNews();
			}
		});
}


function workListType(id,type){
			$.ajax({
			url: "?mod=context&menu=workList&action=chType",
			type: "POST",
			data: "id="+id+"&type="+type,
			success: function(data){
				$("#chStatus").html(data);
			}
		});
}
function workListPrior(id,type){
			$.ajax({
			url: "?mod=context&menu=workList&action=chPrior",
			type: "POST",
			data: "id="+id+"&type="+type,
			success: function(data){
				$("#prStatus").html(data);
			}
		});
}
function workListStatus(id,type){
			$.ajax({
			url: "?mod=context&menu=workList&action=chStatus",
			type: "POST",
			data: "id="+id+"&type="+type,
			success: function(data){
				$("#Status").html(data);
			}
		});
}
///////////////spamList////////////////////
function spamShowList(){
	$('#spamList').html('Loading...');
	$('#spamList').load(path+'?mod=context&menu=spamList&action=showList');
}
function spamDelWord(id){
	$('#spamMsg').load(path+'?mod=context&menu=spamList&action=delWord&id='+id);
	spamShowList();
}
function spamAddHideShow(element_id){
	if (document.getElementById(element_id)){
		var obj = document.getElementById(element_id); 
		if (obj.style.display != "block"){ 
			obj.style.display = "block"; 
		}
		else{
			obj.style.display = "none";
		}			
	}
	else alert("Element id: " + element_id + " not found!"); 
}
function spamAddWord(){
	var spamWord = $("#spamWord").val();
	$.ajax({
		url: "?mod=context&menu=spamList&action=addWord",
		type: "POST",
		data: "word="+spamWord,
		success: function(data){
			$("#spamMsg").html(data);
		}
	});
	spamShowList();
	spamAddHideShow('spamAdd');
}
///////////////////////////////////////////
function clanLoad(){
	$('#clan_list').load('?mod=context&menu=clanEditor&action=loadClans');
}
function clanEditSave(id){

	var clanInfo = encodeURI($("#clanInfo").val());
	var clanDeviz = encodeURI($("#clanDeviz").val());
	var clanSite = encodeURI($("#clanSite").val());
	
	$.ajax({
		url: "?mod=context&menu=clanEditor&action=editClanSave&clanId="+id+"",
		type: "POST",
		data: "clanInfo="+clanInfo+"&clanDeviz="+clanDeviz+"&clanSite="+clanSite+"",
		beforeSend: function(){
			$('#saveStatus').text('Saving...');
		},
		success: function(data){
			$("#saveStatus").html(data);
		}
	});
}


///////////////////////////////////////////