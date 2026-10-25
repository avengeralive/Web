
function treemultiplefrom(id, url){
var treetype = 'treemultiplefrom';
return treeabstract(id, url,treetype);
}

function  treemultipleto(id, url){
var treetype = 'treemultipleto';
return treeabstract(id, url,treetype);
}

function tree(id, url) {
var treetype = 'tree';
return treeabstract(id, url,treetype);
}


function treeabstract(id, url,treetype) {


//alert(documentid);

	var element = document.getElementById(id)



		function getfotrmbutton(childid){
			if (treetype=='tree') {
				// на карточке товара перемещаем один документ - "куда"
				return  '<form action="/edit_move.php" method="get" style="display: inline;"><input type="hidden" name="action" value="single"><input type="hidden" name="documentid" value="'+documentid+'"><input type=hidden name=newrootid value="'+childid+'"><input type=submit style="width: 10em; display: inline;" value="Переместить сюда"></form>';
				};
			if (treetype=='treemultiplefrom'){
				// много сразу - указываем галочками много документов которые нужно переместить "откуда" 
				return  '<label for="child'+childid+'"><input type="checkbox" class="sm" id="child'+childid+'" name="child'+childid+'" value="'+childid+'">Отметить</label>';
				};
			if (treetype=='treemultipleto') {
				// много сразу - указываем перемещаем "куда"
				return  '<label for="to'+childid+'"><input type="radio" class="sm" name="to" id="to'+childid+'" value="'+childid+'">выбрать</label>';
				};
			return '*';
			}





	function hasClass(elem, className) {
		return new RegExp("(^|\\s)"+className+"(\\s|$)").test(elem.className)
	}

	function toggleNode(node) {
		var newClass = hasClass(node, 'ExpandOpen') ? 'ExpandClosed' : 'ExpandOpen'
		var re =  /(^|\s)(ExpandOpen|ExpandClosed)(\s|$)/
		node.className = node.className.replace(re, '$1'+newClass+'$3')
	}

	function load(node) {

		function showLoading(on) {
			var expand = node.getElementsByTagName('DIV')[0]
			expand.className = on ? 'ExpandLoading' : 'Expand'
		}


		function onSuccess(data) {
			if (!data.errcode) {
				onLoaded(data)
				showLoading(false)
			} else {
				showLoading(false)
				onLoadError(data)
			}
		}


		function onAjaxError(xhr, status){
			showLoading(false)
			var errinfo = { errcode: status }
			if (xhr.status != 200) {
				errinfo.message = xhr.statusText
			} else {
				errinfo.message = 'ajax error'
			}
			onLoadError(errinfo)
		}



		function onLoaded(data) {

			for(var i=0; i<data.length; i++) {
				var child = data[i]
				var li = document.createElement('LI')
				li.id = child.id

				li.className = "Node Expand" + (child.isFolder ? 'Closed' : 'Leaf')
				if (i == data.length-1) li.className += ' IsLast'


				li.innerHTML = '<div class="Expand"></div><div class="Content">'+child.title+' <a href="'+child.url+'">Перейти</a> '+getfotrmbutton(child.id)+'</div>'
				if (child.isFolder) {
					li.innerHTML += '<ul class="Container"></ul>'
				}
				node.getElementsByTagName('UL')[0].appendChild(li)
			}

			node.isLoaded = true
			toggleNode(node)
		}

		function onLoadError(error) {
			var msg = "РћС€РёР±РєР° "+error.errcode
			if (error.message) msg = msg + ' :'+error.message
			alert(msg)
		}


		showLoading(true)

		if (node.id){
			urlfull = url+"?id="+node.id;
			}
		else {
			urlfull = url;
			};
		$.ajax({
			url: urlfull,
			data: node.id,
			dataType: "json",
			success: onSuccess,
			error: onAjaxError,
			cache: false
		})
	}

	element.onclick = function(event) {
		event = event || window.event
		var clickedElem = event.target || event.srcElement

		if (!hasClass(clickedElem, 'Expand')) {
			return // РєР»РёРє РЅРµ С‚Р°Рј
		}

		var node = clickedElem.parentNode
		if (hasClass(node, 'ExpandLeaf')) {
			return // РєР»РёРє РЅР° Р»РёСЃС‚Рµ
		}

		if (node.isLoaded || node.getElementsByTagName('LI').length) {
			toggleNode(node)
			return
		}


		if (node.getElementsByTagName('LI').length) {
			toggleNode(node)
			return
		}


		load(node)


	}

}
