function checkDefault(obj, phrase, mode, color){
	if(mode == 1 && obj.value == phrase){
		obj.value = '';
		obj.style.color = '#'+color;
	}else if(obj.value == ''){
		obj.value = phrase;
		obj.style.color = '#'+color;
	}
}

function sfunc(action)
{
    var word,url;
    
    switch(action)
    {
        case 'activate' : word='активировать объекты';url='activate';break;
        case 'deactivate' : word='деактивировать объекты';url='deactivate';break;
        case 'archive' : word='поместить в архив объекты';url='archive';break;
        case 'delete' : word='удалить объекты';url='delete';break;
        case 'rubric' : word='добавить рубрику объектам';url='rubric';break;
        case 'unrubric' : word='удалить рубрику у объектов';url='unrubric';break;
    }
    
    if(confirm('Действительно хотите '+word+'?'))
    {
        document.forms['filter_form'].action+=url+'/';
        document.forms['filter_form'].submit();
    }
}

function cfunc(obj)
{
    $("."+obj.className).attr('checked', obj.checked);
}

function uncut(value)
{
  var id_c='cut';
  var id_u='uncut';
  
  if(value!==undefined)
  {
    id_c+='-'+value;
    id_u+='-'+value;
  }
    
  document.getElementById(id_c).style.display='inline';  
  document.getElementById(id_u).style.display='none';
}

function cut(value)
{
  var id_c='cut';
  var id_u='uncut';
  
  if(value!==undefined)
  {
    id_c+='-'+value;
    id_u+='-'+value;
  }
    
  document.getElementById(id_u).style.display='inline';    
  document.getElementById(id_c).style.display='none';  
  
}

function add_related(id_type)
{
  $.ajax({
  url: "/admin/output/ajax_type.php?id_type="+id_type+"&num="+ajax_type_count+"&sid="+$("#sid").val(),
  cache: false,
  success: function(html){
    $("#inner_objects").append(html);
    ajax_type_count++;
  }
});
}