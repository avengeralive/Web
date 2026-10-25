<?php
require_once(Backstage::gi()->ADMIN_TEMPLATE_DIR.'views/header.php');
require_once('navigation.php');
echo '<h1>'.Translations::gi()->forms.'</h1>';
echo '<hr/>';
echo $crud_forms;
echo '<br/><br/><hr/>';
echo '<h3>'.Translations::gi()->form_selects.'</h3>';
echo $crud_selects;

require_once(Backstage::gi()->ADMIN_TEMPLATE_DIR.'views/footer.php');

?>
<script type="text/javascript" charset="utf-8">
	function getFormFields(id, obj)
	{
		$.ajax(
		{
			url:"<?php echo Backstage::gi()->portal_url;?>forms/getFormFields/",
			type: "GET",
			data: "form_id="+id,
			success:function(data)
			{
				$('#forms_edit_modal').modal();
				$('#forms_edit_modal_body').html(data);
			},
			error: function (request, status, error) {
				console.log(request.responseText);
			}                        
		}); 	
	}	
	
	function getFormFieldSelectOptions(id, obj)
	{
		$.ajax(
		{
			url:"<?php echo Backstage::gi()->portal_url;?>forms/getFormFieldSelectOptions/",
			type: "GET",
			data: "field_select_id="+id,
			success:function(data)
			{
				$('#forms_edit_modal').modal();
				$('#forms_edit_modal_body').html(data);
			},
			error: function (request, status, error) {
				console.log(request.responseText);
			}                        
		}); 	
	}
	
$(function()
{
	$('#forms_save_btn').click(function(){
		$.ajax(
		{
			url: $('#forms_common_form').attr('action'),
			type: "POST",
			data: {
				form_values: JSON.stringify($('#forms_common_form').serializeJSON())
			},
			success:function(data)
			{
				$('#forms_edit_modal').modal('hide');
				$('.modal-backdrop').remove();
			},
			error: function (request, status, error) 
			{
				console.log(request.responseText);
			}
		});
	});
});

</script>
<!-- Modal view -->
<div class="modal fade" id="forms_edit_modal" tabindex="-1" role="dialog" aria-labelledby="view_label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="view_label">Baxmaq</h4>
      </div>
      <div class="modal-body" id="forms_edit_modal_body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Bağlamaq</button>
        <button type="button" class="btn btn-primary" id="forms_save_btn">Yaddaşa vermək</button>		
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
