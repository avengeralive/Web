<?php $this->Html->addCrumb('План', '/plans'); ?>

<div class="row">
	<div class="col-md-12">
		<h2>План</h2>
	</div>
</div>

<div id="app">
	<div class="row">
		<div class="col-sm-12">
		<div class="well">
			<?php
				if (AuthComponent::user('role') == 'Администратор'
					|| (AuthComponent::user('organ_id') && AuthComponent::user('organ_id') != 0)
					|| (AuthComponent::user('institution_id') && AuthComponent::user('institution_id') != 0)) {
					echo $this->Form->input('institution_id', ['label'=>'Учреждение ветеринарии', 'div'=>'col-sm-5', 'wrapInput' => false, 'class' => 'form-control', 'v-model' => 'institution_id']);
					echo $this->Form->input('lab_id', ['label'=>'Лаборатория', 'div'=>'col-sm-5', 'wrapInput' => false, 'class' => 'form-control', 'v-model' => 'lab_id']);
				}
			?>
			<div class="col-sm-1">
				<label for="institution_id-selectized">С</label>
				<select v-model="monthFrom" class="form-control">
					<option v-for="m in months" v-bind:value="m.value">{{ m.text }}</option>
				</select>
			</div>
			<div class="col-sm-1">
				<label for="institution_id-selectized">По</label>
				<select v-model="monthTo" class="form-control">
					<option v-for="m in monthsTo" v-bind:value="m.value">{{ m.text }}</option>
				</select>
			</div>
			<div style="width:100px;margin:auto">
				<label>&nbsp;</label>
				<button v-on:click="getReport" type="button" class="btn btn-primary form-control">Отчет</button>
			</div>
		</div>
		</div>
	</div>
</div>
<div id="myGrid" style="min-height:200px;height: 100%;width: 100%;background: transparent;font-family: arial;" class="ag-theme-balham"></div>


<?php $this->start('css');?>
<link rel="stylesheet" href="https://unpkg.com/ag-grid/dist/styles/ag-grid.css">
<link rel="stylesheet" href="https://unpkg.com/ag-grid/dist/styles/ag-theme-balham.css">
<style>
	.ag-theme-balham .ag-header-cell, .ag-theme-balham .ag-header-group-cell {
		padding-left: 2px;
		padding-right: 2px;
	}
	.ag-theme-balham .ag-header-cell-label {
		width: 100%;
	}

	.ag-theme-balham .ag-header-group-text, .ag-theme-balham .ag-header-cell-text
	{
		width:100%;
		text-align: center;
	}

	.ag-theme-balham .ag-cell.right-border {
		border-right: 1px solid #d9dcde;
	}

	.ag-theme-balham .ag-cell.ag-cell-focus {
		border-right: 1px solid #0091EA;
	}

	.ag-theme-balham .ag-cell.right-align {
		text-align: right;
	}

	.ag-bl-overlay {
		z-index: 4;
		background-color: white;
	}

</style>
<?php $this->end(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/es6-shim/0.35.3/es6-shim.min.js"></script>
<!-- development version, includes helpful console warnings -->
<!-- <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script> -->
<!-- production version, optimized for size and speed-->
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="https://unpkg.com/ag-grid/dist/ag-grid.min.noStyle.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script type="text/javascript">
var app = new Vue({
	el: '#app',
	data: {
		title: 'План',
		gridOptions: {},
		columnDefs: null,
		rowData: [],
		eGridDiv: null,
		institution_id: null,
		lab_id: null,
		monthFrom: 1,
		monthTo: 1,
		months: [
			{ text: 'Январь', value: 1 }, { text: 'Февраль', value: 2 },
			{ text: 'Март', value: 3 }, { text: 'Апрель', value: 4 },
			{ text: 'Май', value: 5 }, { text: 'Июнь', value: 6 },
			{ text: 'Июль', value: 7 }, { text: 'Август', value: 8 },
			{ text: 'Сентябрь', value: 9 }, { text: 'Октябрь', value: 10 },
			{ text: 'Ноябрь', value: 11 }, { text: 'Декабрь', value: 12 }
		]
	},
	computed: {
		monthsTo: function() {
			if (this.monthFrom > this.monthTo) {
				this.monthTo = this.monthFrom;
			}
			return this.months.filter(m => m.value >= this.monthFrom);
		}
	},
	methods: {
		getReport: function() {
			var self = this;
			var config = {	headers: {'Content-Type': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'Cache-Control' : 'no-cache'}, responseType:'Blob' };
			axios({
				url: '/plans/report',
				method: 'post',
				data: {
					lab_id: self.lab_id == 'all' ? null : self.lab_id,
					institution_id: self.institution_id == 'all' ? null : self.institution_id,
					month_from: self.monthFrom,
					month_to: self.monthTo
				},
				withCredentials: true,
				responseType: 'blob',
				headers: {
				  'Accept': 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
				}
			}).then((response) => {
				  const url = window.URL.createObjectURL(new Blob([response.data]));
				  const link = document.createElement('a');
				  link.href = url;
				  link.setAttribute('download', 'report.xlsx');
				  document.body.appendChild(link);
				  link.click();
				  document.body.removeChild(link);
			}).catch(function (error) {
				alert(error);
			});
		},
		setInstitution: function(id) {
			this.institution_id = id;
		},
		setLab: function(id) {
			this.lab_id = id;
			if(!id) return;
			//TODO: add full report in controller
			if(this.institution_id == 'all' && id == 'all')
			{
				this.gridOptions.api.setRowData([]);
				return;
			}
			this.loadData();
		},
		loadData: function() {
			var self = this;
			var config = {	headers: {'Content-Type': 'application/json','Cache-Control' : 'no-cache'}};
			axios.get('/plans/search/' + self.institution_id + '/' + self.lab_id + '.json', config).then(function(resp) {
				self.rowData = self.pivotData(resp.data.data);
				self.gridOptions.api.setRowData(self.rowData);
				self.gridOptions.api.sizeColumnsToFit();
				window.onresize = function() {
					self.gridOptions.api.sizeColumnsToFit();
				}
			});
		},
		pivotData: function(data) {
			var result = [];
			var curProdType = '';
			var curPlan;
			data.forEach(function(item) {
				if (curProdType !== item.ProductionType.name)
				{
					curProdType = item.ProductionType.name;
					curPlan = {
						ProductionType: {
							id: item.Plan.production_type_id,
							name: curProdType,
						}
					};
					result.push(curPlan);
				}
				curPlan['Month' + item.Plan.month] = {
					Plan: {
						id: item.Plan.id,
						production_type_id: item.Plan.production_type_id
					},
					month: item.Plan.month,
					price: item.Plan.price == null? 0: item.Plan.price,
					count: item.Plan.count == null? 0: item.Plan.count
				}
			});
			return result;
		}
	},
	watch: {

	},
	created: function() {
		var self = this;
		self.columnDefs = [
			{
				headerName: 'Вид продукции',
				field: 'ProductionType.name',
				width: 270,
				editable: false,
				suppressSizeToFit: true,
				suppressResize: false,
				pinned: 'left',
				cellClass: 'right-border'
			},
			{ headerName: 'Январь', children: [
				{ headerName: 'Кол-во', field: 'Month1.count' },
				{ headerName: 'Сумма', field: 'Month1.price' }
			]},
			{ headerName: 'Февраль', children: [
				{ headerName: 'Кол-во', field: 'Month2.count' },
				{ headerName: 'Сумма', field: 'Month2.price' }
			]},
			{ headerName: 'Март', children: [
				{ headerName: 'Кол-во', field: 'Month3.count' },
				{ headerName: 'Сумма', field: 'Month3.price' }
			]},
			{ headerName: 'Апрель', children: [
				{ headerName: 'Кол-во', field: 'Month4.count' },
				{ headerName: 'Сумма', field: 'Month4.price' }
			]},
			{ headerName: 'Май', children: [
				{ headerName: 'Кол-во', field: 'Month5.count' },
				{ headerName: 'Сумма', field: 'Month5.price' }
			]},
			{ headerName: 'Июнь', children: [
				{ headerName: 'Кол-во', field: 'Month6.count' },
				{ headerName: 'Сумма', field: 'Month6.price' }
			]},
			{ headerName: 'Июль', children: [
				{ headerName: 'Кол-во', field: 'Month7.count' },
				{ headerName: 'Сумма', field: 'Month7.price' }
			]},
			{ headerName: 'Август', children: [
				{ headerName: 'Кол-во', field: 'Month8.count' },
				{ headerName: 'Сумма', field: 'Month8.price' }
			]},
			{ headerName: 'Сентябрь', children: [
				{ headerName: 'Кол-во', field: 'Month9.count' },
				{ headerName: 'Сумма', field: 'Month9.price' }
			]},
			{ headerName: 'Октябрь', children: [
				{ headerName: 'Кол-во', field: 'Month10.count' },
				{ headerName: 'Сумма', field: 'Month10.price' }
			]},
			{ headerName: 'Ноябрь', children: [
				{ headerName: 'Кол-во', field: 'Month11.count' },
				{ headerName: 'Сумма', field: 'Month11.price' }
			]},
			{ headerName: 'Декабрь', children: [
				{ headerName: 'Кол-во', field: 'Month12.count' },
				{ headerName: 'Сумма', field: 'Month12.price' }
			]},

		];

		self.gridOptions = {
			columnDefs: self.columnDefs,
			rowData: self.rowData,
			enableColResize: true,
			enableFilter: false,
			gridAutoHeight: true,
			enableCellChangeFlash: true,
			defaultColDef: {
				minWidth: 45,
				editable: true,
				suppressMovable: true,
				suppressMenu: true,
				suppressResize: true,
				cellClass: 'right-border right-align',
				editable: function() { return self.lab_id && self.lab_id != 'all'; },
				cellEditor: 'numericCellEditor'
			},
			localeText: {
				noRowsToShow: 'нет данных'
			},
			onCellValueChanged: function(event) {
				if(event.oldValue===event.newValue) return;
				var monthCol = event.colDef.field.split(".")[0];
				var monthData = event.data[monthCol];
				var sendData = {
					id: monthData.Plan.id,
					count: monthData.count,
					price: monthData.price,
					month: monthData.month,
					institution_id: self.institution_id,
					lab_id: self.lab_id,
					production_type_id: event.data.ProductionType.id
				}
				axios.post('/plans/store.json', sendData).then(function(resp) {
					var id = resp.data.data;
					monthData.Plan.id = id;
					 
					var updateTransaction = self.gridOptions.api.updateRowData({ update: [event.data] });

					self.gridOptions.api.refreshCells({
						rowNodes: updateTransaction.update,
						force: true
					});
				}).catch(function(error) {
					alert(error.response.data.message);
					var month = event.colDef.field.split(".");
					event.data[month[0]][month[1]] = event.oldValue;
					self.gridOptions.api.refreshCells();
				});

			},
			components:{
				numericCellEditor: NumericCellEditor,
			}
		};

		//self.eGridDiv = document.querySelector('#myGrid');

		new agGrid.Grid(document.querySelector('#myGrid'), self.gridOptions);
	}
});

$(function () {
	var xhr;
	var select_institution, $select_institution;
	var select_lab, $select_lab;

	$select_institution = $('#institution_id').selectize({
		plugins: ['restore_on_backspace'],
		create: false,
		selectOnTab: true,
		onInitialize: function() {this.selected_value = this.getValue();},
		onDropdownClose: function($dropdown) {
			if(this.getValue() == '') {
				this.setValue(this.selected_value);
			}
		},
		sortField: [[]],
		onChange: function(value) {
			value=value==''?this.selected_value:value;this.selected_value=value;
			if (!value.length) return;
			app.setInstitution(value);
			select_lab.disable();
			select_lab.clearOptions();
			select_lab.load(function(callback) {
				xhr && xhr.abort();
				xhr = $.ajax({
					type: 'post',
					data: 'data[institution_id]='+select_institution.selected_value,
					url: '<?php echo $this->Html->url(array('controller'=>'labs','action'=>'getByInstitution', 'ext'=>'json'));?>',
					success: function(results) {
						if (value != 'all' && value != null) {
							select_lab.enable();
						}
						callback(results);
						select_lab.setValue('all');
					},
					error: function() {
						callback();
					}
				})
			});
		}
	});

	$select_lab = $('#lab_id').selectize({
		valueField: 'id',
		labelField: 'name',
		searchField: ['name'],
		plugins: ['restore_on_backspace'],
		create: false,
		selectOnTab: true,
		sortField: [[]],
		//onInitialize: function() {this.selected_value = 'all';},//this.getValue();},
		onChange: function(value) {
			// value=value==''?'all':value;
			// value=value=='all'?this.selected_value:value;
			// this.selected_value=value;
			app.setLab(value);
		},
		onDropdownClose: function($dropdown) {
			if(this.getValue()=='') {
				this.setValue('all');
			}
		}
	});

	select_lab  = $select_lab[0].selectize;
	select_lab.disable();
	select_institution = $select_institution[0].selectize;

	//select_lab.disable();

});


function getCharCodeFromEvent(event) {
	event = event || window.event;
	return (typeof event.which == "undefined") ? event.keyCode : event.which;
}

function isCharNumeric(charStr) {
	return !!/[\d|\.]/.test(charStr);
}

function isKeyPressedNumeric(event) {
	var charCode = getCharCodeFromEvent(event);
	var charStr = String.fromCharCode(charCode);
	return isCharNumeric(charStr);
}

// function to act as a class
function NumericCellEditor() {
}

// gets called once before the renderer is used
NumericCellEditor.prototype.init = function (params) {
	// create the cell
	this.eInput = document.createElement('input');

	if (isCharNumeric(params.charPress)) {
		this.eInput.value = params.charPress;
	} else {
		if (params.value !== undefined && params.value !== null) {
			this.eInput.value = params.value;
		}
	}

	var that = this;
	this.eInput.addEventListener('keypress', function (event) {
		if (!isKeyPressedNumeric(event)) {
			that.eInput.focus();
			if (event.preventDefault) event.preventDefault();
		} else if (that.isKeyPressedNavigation(event)){
			event.stopPropagation();
		}
	});

	// only start edit if key pressed is a number, not a letter
	var charPressIsNotANumber = params.charPress && ('1234567890'.indexOf(params.charPress) < 0);
	this.cancelBeforeStart = charPressIsNotANumber;
};

NumericCellEditor.prototype.isKeyPressedNavigation = function (event){
	return event.keyCode===39
		|| event.keyCode===37;
};


// gets called once when grid ready to insert the element
NumericCellEditor.prototype.getGui = function () {
	return this.eInput;
};

// focus and select can be done after the gui is attached
NumericCellEditor.prototype.afterGuiAttached = function () {
	this.eInput.focus();
};

// returns the new value after editing
NumericCellEditor.prototype.isCancelBeforeStart = function () {
	return this.cancelBeforeStart;
};

// example - will reject the number if it contains the value 007
// - not very practical, but demonstrates the method.
NumericCellEditor.prototype.isCancelAfterEnd = function () {
	var value = this.getValue();
	return value.indexOf('007') >= 0;
};

// returns the new value after editing
NumericCellEditor.prototype.getValue = function () {
	return this.eInput.value;
};

// any cleanup we need to be done here
NumericCellEditor.prototype.destroy = function () {
	// but this example is simple, no cleanup, we could  even leave this method out as it's optional
};

// if true, then this editor will appear in a popup
NumericCellEditor.prototype.isPopup = function () {
	// and we could leave this method out also, false is the default
	return false;
};

</script>
