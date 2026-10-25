Ext.define('Plugin.sale.OrderEdit', {
    extend:'Ext.Window',

    modal: true,
    autoShow: true,
    width: '60%',
    height: '60%',
    minWidth: 400,
    minHeight: 300,
		
    initComponent: function(){

		this.title = _('Заказ №')+this.record.getId() + ' '+ _('от') +' ' + this.record.get('date'); 
		
		var d = this.record.getData();
		
        Ext.apply(this, {
			
			items: [
				{
					height:70,
					data: d,
					tpl: [
						'<div style="font-size: 150%">',
						_('Статус оплаты')+': <b id="x-pay-status">{paid_text}</b> <span id="x-pay-button"></span><br>',
						_('Статус заказа')+': <b id="x-status">{status_text}</b> <span id="x-status-button"></span><br>',
						'</div>'
					]					
				},
				{
					layout: 'fit',
					flex:1,
					items: {
						data: d,
						padding: 5,
						bodyPadding: 5,	
						overflowY: 'auto',						
						tpl: [
							'<div style="float: right"><span id="x-props-edit-button"></span></div>',
							'<p><b>'+_('Покупатель')+':</b> <a href="javascript:Cetera.getApplication().openBoLink(\'user:{user_id}\')">{buyer}</a></p>',
							'<p><b>'+_('Способ оплаты')+':</b> {payment_data.name}</p>',
							'<p><b>'+_('Способ доставки')+':</b> {delivery_data.name}</p>',
							'<p>{delivery_note}</p>',
							'<tpl for="props">', 
								'<p><b>{name}:</b> {value}</p>', 
							'</tpl>'
						]
					}
				},				
				{
					flex:1,
					layout: {
						type: 'hbox',
						pack: 'start',
						align: 'stretch'
					},
					defaults: {
						padding: 5,
						bodyPadding: 5,
						overflowY: 'auto'
					},			
					items: [
						{
							title:_('Товары'),
							flex:2,
							data: d,
							tpl: [
								'<table cellpadding="3" class="stats" width="100%">',
								'<tr>',
									'<td class="total">'+_('Товар')+'</td><td class="total">'+_('Цена')+'</td><td class="total">'+_('Кол-во')+'</td><td class="total">'+_('Стоимость')+'</td>',
								'</tr>',				
								'<tpl for="products">',  
									'<tr>',
										'<td>',
											'{bo_url}',
											'<tpl for="options">', 
												'<br>{name}: {value}, {code}',
											'</tpl>',											
										'</td><td>{price}</td><td>{quantity}</td><td>{sum}</td>',
									'</tr>',
								'</tpl>',
								'<tr>',
								'<td colspan="3" class="total">'+_('Всего')+':</td><td class="total">{products_cost}</td>',
								'</tr>',				
								'</table>'
							]
						},
						{
							title:'Сумма', 
							flex:1,
							data: d,
							tpl: [
								'<p>'+_('Товары')+': {products_cost}</p>',
								'<p>'+_('Доставка')+': {delivery_cost}</p>',
								'<p style="font-size: 120%; font-weight: bold">'+_('Всего')+': {total}</p>',
							]
						}
					]			
				}
			]	
	 			
			
		});
		
		this.callParent();		
		
    },
	
	updateTemplates: function(){
		
		var panels = this.query('panel');
		for (var i = 0; i < panels.length; i++)
			panels[i].update( this.record.getData() ); 
		
	},		
	
	drawButtons: function(){	
		
		Ext.get("x-pay-status").setVisibilityMode( Ext.dom.AbstractElement.DISPLAY );
		Ext.get("x-status").setVisibilityMode( Ext.dom.AbstractElement.DISPLAY );
		
		this.pay_change = Ext.create('Ext.form.ComboBox', {
			store: Ext.create('Ext.data.JsonStore',{
                autoDestroy: true,
                autoLoad: true,
                fields: ['id', 'name'],
				proxy: {
                    type: 'ajax',
                    url: '/plugins/sale/data_orders.php?action=get_pay_status_list',
                    reader: {
                        type: 'json',
						root: 'rows'
					}
				}                   
            }),
            valueField:'id',
            displayField:'name',
            editable: false,
			value: this.record.get('paid'),
			style: 'display:inline-block; vertical-align: middle',
			hidden: true
        });		
		this.pay_change.render(document.body, 'x-pay-button');
		
		this.pay_ok_btn = Ext.create('Ext.Button',{
			text: 'OK',
			hidden: true,
			scope: this,
			margin: '0 0 0 5',
			handler: function(button) {
				
				this.record.set( 'paid', this.pay_change.getValue() );
				this.record.set( 'paid_text', this.pay_change.getDisplayValue() );
				this.store.sync();
				
				this.pay_change_btn.show();
				this.pay_ok_btn.hide();
				this.pay_cancel_btn.hide();
				this.pay_change.el.applyStyles('display:none');	
				Ext.get("x-pay-status").update( this.pay_change.getDisplayValue() ).show();				
			}
		});
		this.pay_ok_btn.render(document.body, 'x-pay-button'); 	

		this.pay_cancel_btn = Ext.create('Ext.Button',{
			text: _('Отмена'),
			margin: '0 0 0 5',
			hidden: true,
			scope: this,
			handler: function(button) {
				this.pay_change_btn.show();
				this.pay_ok_btn.hide();
				this.pay_cancel_btn.hide();
				this.pay_change.el.applyStyles('display:none');
				Ext.get("x-pay-status").show();
			}
		});
		this.pay_cancel_btn.render(document.body, 'x-pay-button'); 	
		
		this.pay_change_btn = Ext.create('Ext.Button',{
			text: _('Изменить ...'),
			margin: '0 0 0 5',
			scope: this,
			handler: function(button) {
				this.pay_change.el.applyStyles('display:inline-block');
				Ext.get("x-pay-status").hide();
				this.pay_ok_btn.show();
				this.pay_cancel_btn.show();
				this.pay_change_btn.hide();
			}
		});
		this.pay_change_btn.render(document.body, 'x-pay-button'); 
		
		this.status_change = Ext.create('Ext.form.ComboBox', {
			store: Ext.create('Ext.data.JsonStore',{
                autoDestroy: true,
                autoLoad: true,
                fields: ['id', 'name'],
				proxy: {
                    type: 'ajax',
                    url: '/plugins/sale/data_orders.php?action=get_status_list',
                    reader: {
                        type: 'json',
						root: 'rows'
					}
				}                   
            }),
            valueField:'id',
            displayField:'name',
            editable: false,
			value: this.record.get('paid'),
			style: 'display:inline-block; vertical-align: middle',
			hidden: true
        });		
		this.status_change.render(document.body, 'x-status-button');
		
		this.status_ok_btn = Ext.create('Ext.Button',{
			text: 'OK',
			hidden: true,
			scope: this,
			margin: '0 0 0 5',
			handler: function(button) {
				
				this.record.set( 'status', this.status_change.getValue() );
				this.record.set( 'status_text', this.status_change.getDisplayValue() );
				this.store.sync();
				
				this.status_change_btn.show();
				this.status_ok_btn.hide();
				this.status_cancel_btn.hide();
				this.status_change.el.applyStyles('display:none');	
				Ext.get("x-status").update( this.status_change.getDisplayValue() ).show();				
			}
		});
		this.status_ok_btn.render(document.body, 'x-status-button'); 	

		this.status_cancel_btn = Ext.create('Ext.Button',{
			text: _('Отмена'),
			margin: '0 0 0 5',
			hidden: true,
			scope: this,
			handler: function(button) {
				this.status_change_btn.show();
				this.status_ok_btn.hide();
				this.status_cancel_btn.hide();
				this.status_change.el.applyStyles('display:none');
				Ext.get("x-status").show();
			}
		});
		this.status_cancel_btn.render(document.body, 'x-status-button'); 			
		
		this.status_change_btn = Ext.create('Ext.Button',{
			text: _('Изменить ...'),
			margin: '0 0 0 5',
			scope: this,
			handler: function(button) {
				this.status_change.el.applyStyles('display:inline-block');
				Ext.get("x-status").hide();
				this.status_ok_btn.show();
				this.status_cancel_btn.show();
				this.status_change_btn.hide();
			}
		});
		this.status_change_btn.render(document.body, 'x-status-button'); 	

		this.props_edit_btn = Ext.create('Ext.Button',{
			text: _('Изменить ...'),
			margin: '0 0 0 5',
			scope: this,
			handler: function(button) {
				var window = Ext.create('Plugin.sale.OrderEditProps',{
					record: this.record,
					store: this.store,
					listeners: {
						order_updated: {
							fn: function() {
								this.updateTemplates();
								this.drawButtons();
							},
							scope: this
						}						
					}
				});				
			}
		});
		this.props_edit_btn.render(document.body, 'x-props-edit-button');		
	},
	
	afterRender: function() {
		
		this.callParent();
		this.drawButtons();

	},
	
	layout: {
		type: 'vbox',
		padding: 5,
		align : 'stretch',
		pack  : 'start'
	},
	defaults: {
		border: false,
		bodyStyle: 'background: none'
	}    
});