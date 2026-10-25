function colorize(what) {
what.style.background = "#ebfdd9";
what.parentNode.style.background = "#ccff00";
}


// проверка URL на правильность. пустой URL допустим только для самого родительского URL
// используется везде
function checkURLName() {
	if (
		(document.editf.document_id.value == 1) &&
		(document.editf.url.value == '')
		) {
		return true;
	}
	var what = document.editf.url.value;
	var reggurl = /(^[-_A-Za-z0-9]{1,}$)/i;
	if (!reggurl.test(what)) {
		alert("Такой URL ("+ what +") недопустим.\nУкажите название только из латинских букв и/или цифр, без пробелов.");
		return false;
	}
	return true;
}

// подсветка текущего поля формы - для radio
// используется в создании нового документа на 1 этапе.
function colorizeone(what) {
for (var i = 0; i < document.editf.type.length; i++) {
	document.getElementById('c'+document.editf.type[i].id).style.border = "";
	};
document.getElementById(what).style.border = "1px dotted red";
}

// проверка на правильный URL или на пустой URL
// используется в создании нового документа на 1 этапе.
function checkURLNameOrEmpty() {
	if ((document.editf.url.value == '')) {
		return true;
	}
	return checkURLName();
}

// проверка того что выбран тип документа
// используется в создании нового документа на 1 этапе.
function checkFillType() {
	for (var i = 0; i < document.editf.type.length; i++) {
		if (document.editf.type[i].checked) {
			return true;
		}
	}
	alert("Выберите тип создаваемого документа!");
	return false;
}

// проверка что выбран тип документа и правильный URL
// используется в создании нового документа на 1 этапе.
function checkURLandTYPE() {
	var a1 = checkURLNameOrEmpty();
	var a2 = checkFillType();
	return ((a1 == true) && (a2 == true));
}
