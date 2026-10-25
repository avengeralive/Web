<!--
function fillEmptySearch(){
	if (
		(0==document.search.q.value.length) ||
		(1==typed)
		) {
		document.search.q.value = document.search.qq.value;
		typed = 1;
		}
}


function checkSize(){
	if (document.update.content.value.length>(64*1024)) {
		return confirm("Размер сохраняемого файла равен "+document.update.content.value.length+" байт, из за ограничений HTTP протокола он будет обрезан до 64 КБ.\n\n Подверждаете сохранение?");
		};
	}


function ToggleAll(checked) {
for(i=0; i < document.forms.files.elements.length; i++) {
	var item=document.forms.files.elements[i];
	if (item.name == "file[]") {
		item.checked=checked;
		};
	};
}


function checkCreateForm(){
	if (0==document.createfolder.folder.value.length) {
		alert("Введите название создаваемой папки.")
		return false;
		};
	regg = new RegExp("^[- _A-Za-z0-9]{1,}$", "i");
	if (!regg.test(document.createfolder.folder.value)) {
		alert("Такую папку нельзя создать.\n Не используйте символы ..\/ и знаки кириллицы!\nРазрешенные символы -_A-Z a-z 0-9")
		return false;
		};
	}

function checkForm(){

switch(document.forms.files.ID.value) {
	case "delete":
		ss = "\n\n";
		c = 0;
		for(i=0; i < document.forms.files.elements.length; i++) {
			var item=document.forms.files.elements[i];
			if (( item.name == "file[]")  && (item.checked) ) {
				ss = ss + item.value+"\n";
				c++;
				};
			};
		if (c>0){
			return confirm("Вы уверены?\nФайлы "+ss+"\nбудут удалены без возможности восстановления.");
			}
		else {
			alert("Не выбрано ни одного файла к удалению!");
			return false;
			};
		break;

	case "get_zip":
		// уберем редирект
		document.forms.files.action += "/download.zip";
//		document.forms.files.ID.value= "get_zip";
//		alert(document.forms.files.action);
//		alert(document.forms.files.ID.value);
		c = 0;
		for(i=0; i < document.forms.files.elements.length; i++) {
			var item=document.forms.files.elements[i];
			if (( item.name == "file[]")  && (item.checked) ) {
				c++;
				};
			};
		if (0==c){
			alert("Не выбрано ни одного файла к загрузке!");
			return false;
			};
		break;

//	case "customcode":
//		if (0==document.forms.files.customcode.value.length){
//			alert("Не введен PHP код");
//			return false;
//			}
//		else {
//			return confirm("Вы серьезно?\n\n\ К каждому из файлов будет применено\n"+document.forms.files.customcode.value);
//			};
//		break;

	};

}
//-->
