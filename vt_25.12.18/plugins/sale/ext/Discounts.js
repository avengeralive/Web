Ext.define('Plugin.sale.Discounts', {

    extend:'Cetera.grid.Abstract',
	requires: 'Plugin.sale.model.Discount',
	
    columns: [
        {text: "ID",       width: 50, dataIndex: 'id'},
		{text: _('Акт.'),     width: 60, dataIndex: 'active', renderer: function (value) { if (value) return _('Да'); else return _('Нет'); }},
		{text: _('Величина'),    width: 100, dataIndex: 'value_text'},		
        {text: _('Название'), flex: 1, dataIndex: 'name'},
		{text: _('Приоритет'),    width: 60, dataIndex: 'priority'}		
    ],
	
    border: false,
	
	editWindowClass: 'Plugin.sale.DiscountEdit',

	store: {
		model: 'Plugin.sale.model.Discount',
		sorters: [{property: "priority", direction: "ASC"}],
		remoteSort: false,
		autoLoad: true,
		autoSync: true			
	}	
		  
});