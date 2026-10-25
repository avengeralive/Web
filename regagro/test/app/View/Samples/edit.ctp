<?php $this->Html->addCrumb('Журнал', '/registrations'); ?>
<?php $this->Html->addCrumb('Редактирование отбора проб ', ''); ?>

<?php 

echo $this->Form->create('Sample', array(
	'inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	),
	'class' => 'well'
)); ?>

<legend><?php echo $title_for_layout ?></legend>

<?php

		echo $this->Form->input('registration_id', array('type'=>'hidden'));
		echo $this->Form->input('lab_id', array('type'=>'hidden'));
		echo $this->Form->input('code', array('type'=>'hidden'));
		echo $this->Form->input('expertise_id', array('label'=>'Экспертиза'));
		//echo $this->Form->input('production_id', array('label'=>'Конкретная продукция'));
		$prod_options = array_combine(array_values($productions), array_values($productions));
		$prod_options[$this->data['Sample']['production']] = $this->data['Sample']['production'];
		echo $this->Form->input('production', array('label'=>'Конкретная продукция', 'options'=>$prod_options));
		echo $this->Form->input('date', array('label'=>'Дата выработки'));
		echo $this->Form->input('receipt_date', array('label'=>'Дата поступления',
													'id'=> 'datetimepicker_receipt_date',
													'type'=>'text',
													'data-date-format'=>'YYYY-MM-DD',
													'readonly'=>false,
													'beforeInput' => '<div class="input-group">',
													'afterInput' => '<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span></div>'));
		echo $this->Form->input('total_weight', array('label'=>'Вес партии', 'step'=>0.01, 'default'=>0));
		echo $this->Form->input('vetlab_id', array('label'=>'Проба направляется в'));
		echo $this->Form->input('doc', array('label'=>'Нормативный документ'));
		echo $this->Form->input('count', array('label'=>'Количество проб'));
		echo $this->Form->input('samples_weight', array('label'=>'Вес проб', 'step'=>0.01, 'default'=>0));
		echo $this->Form->input('packages', array('label'=>'Сейф-пакет'));
		echo $this->Form->input('gloves', array('label'=>'Перчатки одноразовые'));
		echo $this->Form->input('bottles', array('label'=>'Бутылка пластиковая'));
		echo $this->Form->input('containers', array('label'=>'Контейнер пластиковый'));
		echo $this->Form->input('other', array('label'=>'Прочее'));
		echo $this->Form->input('auto', array('label'=>'Пробег в км с указанием марки и г/н автомобиля'));
        ?>

        <div class="panel panel-info">
			<div class="panel-heading" role="tab" id="conclusionHeadinng">
			  <h4 class="panel-title">
				<a class="" data-toggle="collapse" href="#collapseConclusion" aria-expanded="true" aria-controls="collapseConclusion">
                    Цели отбора проб (<strong>для сохранения изменений необходимо сохранить всю форму</strong>)
				</a>
			  </h4>
			</div>
			<div id="collapseConclusion" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="conclusionHeadinng">
			    <div class="panel-body">
                    <table>
                        <tr id="addRowRow">
                            <td style="min-width:600px; padding-right:30px">
                                <?php
                                echo $this->Form->input('SamplePurposes', array('label'=>'Цель отбора проб',
                                                                                     'type' => 'select',
                                                                                     'multiple'=>'multiple'));
                                ?>
                            </td>
                            <td>
                                <button type="button" id="addRow" class="btn btn-primary btn-sm">Добавить цели</button>
                            </td>
                        </tr>
                    </table>
                    <table class="table">
                        <tr id="headerRow">
                            <th>Цель отбора проб</th>
                            <th>Результат</th>
                            <th>Удалить</th>
                        </tr>
                    <?php
                    $counter = 0;
                    foreach ($sample['SamplePurpose'] as $samplePurpose) {
                        echo '<tr id="formRow'.$counter.'"><td>';
                        echo $this->Form->hidden('SamplePurpose.'.$counter.'.SampleSamplePurpose.id', ['value' => $samplePurpose['SampleSamplePurpose']['id']]);
                        echo $this->Form->hidden('SamplePurpose.'.$counter.'.SampleSamplePurpose.sample_id', ['value' => $samplePurpose['SampleSamplePurpose']['sample_id']]);
                        echo $this->Form->input('SamplePurpose.'.$counter.'.SampleSamplePurpose.sample_purpose_id', ['label' => false,
                                                                                                       'type' => 'select',
                                                                                                       'value' => $samplePurpose['SampleSamplePurpose']['sample_purpose_id']]);
                        echo '</td>';
                        echo '<td>';
                        echo $this->Form->input('SamplePurpose.'.$counter.'.SampleSamplePurpose.positive', ['label'=>'Положительный','div'=>'checkbox', 'class'=>'checkbox']);
                        echo '</td>
                              <td>
                                <button type="button" id="removeBtnRow'.$counter.'" class="btn btn-primary btn"><span class="glyphicon glyphicon-minus"></span></button>
                              </td>
                            </tr>';
                        $counter++;
                    }
                    ?>
                    </table>

                    <table style="display:none">
                        <?php
                        if (count($sample['SamplePurpose'])==0) {
                            echo '<tr id="formRow'.$counter.'"><td>';
                            echo $this->Form->hidden('SamplePurpose.'.$counter.'.SampleSamplePurpose.id');
                            echo $this->Form->hidden('SamplePurpose.'.$counter.'.SampleSamplePurpose.sample_id', ['value' => $sample['Sample']['id']]);
                            echo $this->Form->input('SamplePurpose.'.$counter.'.SampleSamplePurpose.sample_purpose_id', ['label' => false,
                                                                                                           'type' => 'select']);
                            echo '</td>';
                            echo '<td>';
                            echo $this->Form->input('SamplePurpose.'.$counter.'.SampleSamplePurpose.positive', ['label'=>'Положительный','div'=>'checkbox', 'class'=>'checkbox']);
                            echo '</td>
                                  <td>
                                    <button type="button" id="removeBtnRow'.$counter.'" class="btn btn-primary btn"><span class="glyphicon glyphicon-minus"></span></button>
                                  </td>
                                </tr>';
                        }

                        ?>
                    </table>
	            </div>
	        </div>
        </div>

        <?php
		echo $this->Form->input('repeated', ['label'=>'Для повторных исследований','div'=>'checkbox', 'class'=>'checkbox']);
		echo $this->Form->input('mark', array('label'=>'Маркировка'));
		echo $this->Form->input('control_sample', array('label'=>'Хранение контрольной пробы'));
		echo $this->Form->input('package_type', array('label'=>'Вид упаковки'));
		echo $this->Form->input('mark_number', array('label'=>'Номер печати, пломбы'));
		echo $this->Form->submit('Сохранить', array(
			'div' => 'form-group',
			'class' => 'btn btn-primary'
		));
		echo $this->Form->end(); 
?>


<script type="text/javascript">
$(function () {
    $formRowHtml = $('#formRow0').html();
	$('#datetimepicker_receipt_date').datetimepicker({
		language: 'ru',
		pickTime: false,
		defaultDate: '<?php echo $this->data['Sample']['receipt_date']?>',
		minDate: new Date().getFullYear()+'-01-01'
	});

	$('#SampleProduction').selectize({
		plugins: ['restore_on_backspace'],
		selectOnTab: true,
		create: true,
		addPrecedence:true,
		render: {
		    option_create: function(data, escape) {
		      return '<div class="create">Свой вариант: <strong>' + escape(data.input) + '</strong>&hellip;</div>';
		    }
	  	},
		onInitialize: function() {
			this.selected_value = this.getValue();
		}
	});
	$('select').selectize({
		plugins: ['restore_on_backspace'],
		create: false,
		selectOnTab: true,
		onInitialize: function() {this.selected_value = this.getValue();},
		onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
		onDropdownClose: function($dropdown) {
			if(this.getValue()==0) {
				this.setValue(this.selected_value );
			}
		}
	});

    $('[id^="removeBtnRow"]').click(function() {
		$(this).parent().parent().remove();
	});

    var currentRowsCount = <?php echo $counter;?>;
    $('#addRow').unbind('click').click(function(evt) {
        $($('#SampleSamplePurposes').val()).each(function(idx, val)
        {
    		var rowHtml = $formRowHtml.replace(/data\[SamplePurpose\]\[0\]/g,'data[SamplePurpose]['+currentRowsCount+']')
    								 .replace(/SamplePurpose0/g,'SamplePurpose'+currentRowsCount)
    								 .replace(/removeBtnRow0/g,'removeBtnRow'+currentRowsCount);
    		var html = '<tr id="formRow'+currentRowsCount+'">'+rowHtml+'</tr>';
    		$('#headerRow').after(html);
            $('#SamplePurpose'+currentRowsCount+'SampleSamplePurposeId').val('');
            $('#SamplePurpose'+currentRowsCount+'SampleSamplePurposeSamplePurposeId').val(val);
    		$('#SamplePurpose'+currentRowsCount+'SampleSamplePurposeSamplePurposeId').selectize({
    			plugins: ['restore_on_backspace'],
    			create: false,
    			selectOnTab: true,
    			onInitialize: function() {this.selected_value = this.getValue();},
    			onChange: function(value) {value=value==0?this.selected_value:value;this.selected_value=value;},
    			onDropdownClose: function($dropdown) {
    				if(this.getValue()==0) {
    					this.setValue(this.selected_value );
    				}
    			}
    		});

    		//$('input[id$=ExpertiseId]').val($('#ResearchExpertiseId').val());
    		$('#removeBtnRow'+currentRowsCount).click(function() {
    			$(this).parent().parent().remove();
    		});
    		currentRowsCount++;
        });
	});
});
</script>
