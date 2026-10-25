<?php echo $header; ?><?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <a href="<?php echo $restore; ?>" data-toggle="tooltip" title="<?php echo $button_restore; ?>" class="btn btn-warning"><i class="fa fa-undo"></i> <?php echo $button_restore; ?></a>
        <button type="button" form="form-neoseo_admin_quick_links" onclick="$('#form-admin_quick_links').attr('action', '<?php echo $apply; ?>');$('#form-admin_quick_links').submit()" data-toggle="tooltip" title="<?php echo $button_apply; ?>" class="btn btn-default"><i class="fa fa-save"></i></button>
        <button type="submit" form="form-neoseo_admin_quick_links" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a></div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-neoseo_admin_quick_links" class="form-horizontal">
                <p><?php echo $module_description ?></p>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-color"><?php echo $entry_color ?></label>
            <div class="col-sm-10">
               <input type="text" name="color" value="<?php echo $color; ?>" maxlength="6" size="6" id="input-color" class="pick-a-color form-control"/>
               <?php if (isset($error_color)) { ?>
                   <span class="error"><?php echo $error_color; ?></span>
               <?php } ?>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label" for="input-size"><?php echo $entry_size ?></label>
            <div class="col-sm-10">
               <input type="text" name="size" value="<?php echo $size; ?>" maxlength="6" size="6" id="input-size" class="form-control"/>
               <?php if (isset($error_size)) { ?>
                   <span class="error"><?php echo $error_size; ?></span>
               <?php } ?>
            </div>
          </div>
			<h3><?php echo $entry_quick_links ?></h3>
          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="quick-link">
              <thead>
				  <tr>
                   <td class="text-left" style="width:25%"><?php echo $entry_icon; ?></td>
                   <td class="text-left" style="width:25%"><?php echo $entry_route." / ".$entry_title; ?></td>
                   <td class="text-left" style="width:25%"><?php echo $entry_color; ?></td>
                   <td class="text-left"><?php echo $entry_new_window; ?></td>
                   <td class="text-right"><?php echo $entry_sort_order; ?></td>
                   <td>&nbsp;</td>
                 </tr>
              </thead>
              <?php $row = 0; ?>
			   <?php foreach ($quick_links as $quick_link) { ?>
               <tbody id="quick-link-row-<?php echo $row; ?>">
                  <tr>
                    <td class="text-left">
				       <div class="input-group">
					     <input class="form-control" id="iconpicker-<?php echo $row; ?>" type="text" name="quick_links[<?php echo $row; ?>][icon]" size="8" value="<?php echo $quick_link['icon']; ?>"/>
					     <span class="input-group-btn">
					       <button class="btn btn-default iconpicker" type="button" data-target="#iconpicker-<?php echo $row; ?>"><i class="fa fa-<?php echo $quick_link['icon']; ?>"></i> <?php echo $entry_icons?></button>
					     </span>
				       </div>						
				     </td>
                    <td class="text-left">
						<?php if (isset($quick_link['manual'])) { ?>
						<input name="quick_links[<?php echo $row; ?>][manual]" value="1" type="hidden" />
						<input class="form-control" type="text" name="quick_links[<?php echo $row; ?>][route]" value="<?php echo $quick_link['route']; ?>" size="25" />
						<?php } else { ?>
				       <select class="form-control" name="quick_links[<?php echo $row; ?>][route]" onchange="fillTitle(this);"></select>
						<?php } ?>
				       <input class="form-control" type="text" name="quick_links[<?php echo $row; ?>][title]" value="<?php echo (isset($quick_link['title']))?$quick_link['title']:''; ?>" size="15" />
				     </td>
                    <td class="text-left">
				       <input class="pick-a-color form-control" type="text" name="quick_links[<?php echo $row; ?>][color]" value="<?php echo (isset($quick_link['color']))?$quick_link['color']:''; ?>" size="6" maxlength="6" />
				     </td>
                    <td class="text-left"><input type="checkbox" name="quick_links[<?php echo $row; ?>][new_window]" value="1" <?php echo (isset($quick_link['new_window']) && $quick_link['new_window']=='1')?"checked":""; ?>/></td>
                    <td class="text-left"><input class="form-control" type="text" name="quick_links[<?php echo $row; ?>][sort_order]" value="<?php echo $quick_link['sort_order']; ?>" size="3" /></td>
                    <td class="text-right">
					<button type="button" onclick="$('#quick-link-row-<?php echo $row; ?>').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                  </tr>
                  <?php $row++; ?>
               </tbody>
                 <?php } ?>
               <tfoot>
                  <tr>
                    <td colspan="4"></td>
                    <td colspan="2" class="text-right">
						<button type="button" onclick="addAnyLink();" data-toggle="tooltip"  title="<?php echo $button_add_quick_link_manual; ?>" class="btn btn-primary"><i class="fa fa-plus-circle"></i></button>
						<button type="button" onclick="addQuickLink();" data-toggle="tooltip"  title="<?php echo $button_add_quick_link; ?>" class="btn btn-primary"><i class="fa fa-plus"></i></button>
					  </td>
                  </tr>
               </tfoot>
            </table>
			</div>
			</form>
        </div>
    </div>
  </div>
</div>

<style type="text/css">
option[disabled] {
  color: #933;
  background-color: #ffc;
}
.table-responsive {
  overflow-x: unset;
}
.iconpicker-container {
 z-index: 10;
}
</style>

<script type="text/javascript">

	$(document).ready(function () {

		$(".pick-a-color").add('input[name$="color]"]').pickAColor({
		  showSpectrum            	: true,
			showSavedColors         : true,
			saveColorsPerElement    : true,
			fadeMenuToggle          : true,
			showAdvanced			: true,
			showBasicColors         : true,
			showHexInput            : true,
			allowBlank				: true,
			inlineDropdown			: true
		});
		
	});

var menu = $("#menu").getAdminLinks();//get menu:
var row = <?php echo $row; ?>;
/*
$('input[name="color"]').add('input[name$="color]"]').ColorPicker({
    onSubmit: function(hsb, hex, rgb, el) { $(el).val(hex); $(el).ColorPickerHide();},
    onBeforeShow: function () { $(this).ColorPickerSetColor(this.value); }
});
*/

fillLinkOptions($('select[name$="route]"]'));

//selected values
<?php foreach ($quick_links as $key => $quick_link) { ?>
	<?php if (!isset($quick_link['manual'])) { ?>
$('select[name="quick_links[<?php echo $key?>][route]"] option[value="<?php echo $quick_link["route"]?>"]').attr("selected", true);
	<?php } ?>
<?php } ?>

$('.iconpicker').iconsPicker();
//change title onchange
function fillTitle(elem) {
    var title = $(elem).find('option:selected').text().replace(/-/g, '').trim();
    $(elem).parent().find('input[name$="title]"]').val(title);
}

function fillLinkOptions(elem) {
    options = '';
    $.each(menu, function( index, value ) {
        if(value[1].length==0){
            options += '<option value="'+value[1]+'" disabled>'+value[0]+'</option>';
        }else{
            options += '<option value="'+value[1]+'" >'+value[0]+'</option>';
        }
    });
    //extra:
    options += '<option value="module/neoseo_admin_quick_links" ><?php echo "-- ".$heading_title?></option>';
    elem.append(options);
}

function addQuickLink() {
	html  = '<tbody id="quick-link-row-'+row+'"';
    html += '  <tr>';
    html += '    <td class="text-left">';
	html += '		<div class="input-group">';
	html += '			<input class="form-control" id="iconpicker-' + row + '" type="text" name="quick_links[' + row + '][icon]" value=""/>';
	html += '			<span class="input-group-btn">';
	html += '				<button class="btn btn-default iconpicker" type="button" data-target="#iconpicker-<?php echo $row; ?>"><?php echo $entry_icons?></button></span>';
	html += '		</div></td>';
    html += '    <td class="text-left"><select class="form-control" name="quick_links['+row+'][route]" onchange="fillTitle(this);"></select><input class="form-control" type="text" name="quick_links['+row+'][title]" value="" size="25" /></td>';
    html += '    <td class="text-left"><input class="form-control" type="text" name="quick_links['+row+'][color]" value="" size="6" maxlength="6" /></td>';
    html += '    <td class="text-left"><input type="checkbox" name="quick_links['+row+'][new_window]" value="1"/></td>';
    html += '    <td class="text-left"><input class="form-control" type="text" name="quick_links['+row+'][sort_order]" value="1" size="3" /></td>';
    html += '    <td class="text-right"><a onclick="$(\'#quick-link-row-'+row +'\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>"class="btn btn-danger"><i class="fa fa-trash"></i></a></td>';
    html += '  </tr>';
    html += '</tbody>';

    $('#quick-link tfoot').before(html);

    $('input[name$="color]"]:last').pickAColor({
		  showSpectrum            	: true,
			showSavedColors         : true,
			saveColorsPerElement    : true,
			fadeMenuToggle          : true,
			showAdvanced			: true,
			showBasicColors         : true,
			showHexInput            : true,
			allowBlank				: true,
			inlineDropdown			: true
	});
    $('.iconpicker:last').iconsPicker();
    fillLinkOptions($('select[name$="route]"]:last'));
    row++;
}

function addAnyLink() {
	html  = '<tbody id="quick-link-row-'+row+'"';
    html += '  <tr>';
    html += '    <td class="left">';
	html += '		<div class="input-group">';
	html += '			<input class="form-control" id="iconpicker-' + row + '" type="text" name="quick_links[' + row + '][icon]" value=""/>';
	html += '			<span class="input-group-btn">';
	html += '				<button class="btn btn-default iconpicker" type="button" data-target="#iconpicker-<?php echo $row; ?>"><?php echo $entry_icons?></button>';
	html += '			</span>';
	html += '		</div></td>';
    html += '    <td class="left"><input name="quick_links['+row+'][manual]" value="1" type="hidden" /><input class="form-control" type="text" name="quick_links['+row+'][route]" value="" size="25" /> <input class="form-control" type="text" name="quick_links['+row+'][title]" value="" size="25" /></td>';
    html += '    <td class="left"><input class="form-control" type="text" name="quick_links['+row+'][color]" value="" size="6" maxlength="6" /></td>';
    html += '    <td class="left"><input type="checkbox" name="quick_links['+row+'][new_window]" value="1"/></td>';
    html += '    <td class="right"><input class="form-control" type="text" name="quick_links['+row+'][sort_order]" value="1" size="3" /></td>';
    html += '    <td class="left"><a onclick="$(\'#quick-link-row-'+row +'\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>"class="btn btn-danger"><i class="fa fa-trash"></i></a></td>';
    html += '  </tr>';
    html += '</tbody>';

    $('#quick-link tfoot').before(html);

    $('input[name$="color]"]:last').pickAColor({
		  showSpectrum            	: true,
			showSavedColors         : true,
			saveColorsPerElement    : true,
			fadeMenuToggle          : true,
			showAdvanced			: true,
			showBasicColors         : true,
			showHexInput            : true,
			allowBlank				: true,
			inlineDropdown			: true
	});
    $('.iconpicker:last').iconsPicker();
    fillLinkOptions($('select[name$="route]"]:last'));
    row++;
}
</script>
<?php echo $footer; ?>