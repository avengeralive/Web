Ext.require('Cetera.field.FileEditable');
Ext.require('Cetera.field.File');
Ext.require('Cetera.field.Ace');
Ext.require('Cetera.field.Image');
Ext.require('Cetera.field.Folder');

Ext.define('Theme.shop.Config', {

    extend   :'Cetera.theme.Config',  

	bodyStyle:'padding:0; background: none',
	border   : false,
	layout: 'fit',
	
	initComponent: function() {
		
		Ext.apply(this, {	
	        	
			items: {
				xtype:'tabpanel',
				bodyStyle:'background: none;',
				border    : false,
				defaults:{
					bodyStyle:'background:none; padding:5px',
					border   : false,
					layout: 'anchor'
				},	
				
				items:[{
					title: _('Настройки магазина'),
					defaults: {
						labelWidth: 130,
						anchor: '100%'
					}, 	
					defaultType: 'textfield',			
					items: [
						{
							fieldLabel: _('Язык'),
							xtype: 'combo',
							name: 'language',
							store: ['ru','en']
						},				
						{
							fieldLabel: _('Раздел каталога товаров'),
							xtype: 'folderfield',
							name:  'product_catalog',
							only: 'sale_products'
						},
						{
							fieldLabel: _('Логотип'),
							xtype: 'imagefield',
							height: 150,
							name: 'logo'
						},{
							fieldLabel: 'Favicon',
							xtype: 'fileselectfield',
							name: 'favicon'
						},{
							fieldLabel: _('Телефон'),
							name: 'phone'
						},{
							fieldLabel: 'E-mail',
							name: 'email'
						},{
							fieldLabel: _('Адрес'),
							name: 'address'
						},{
							fieldLabel: _('Дополнительный CSS'),
							xtype: 'fileselect_editable',
							name: 'css',
							beautify: true,
							minify: true,
							value: ''
						},{
							fieldLabel: _('Дополнительный JS'),
							xtype: 'fileselect_editable',
							name: 'js',
							value: ''
						}
					]
				},{
					title: _('Файлы'),
					defaults: {
						labelWidth: 150,
						anchor: '100%',
						getFileSuffix: function() {
							var form = this.up('form');
							return form.getFileSuffix();
						}
					}, 		
					items: [
						{
							fieldLabel: _('Главный шаблон'),
							xtype: 'fileselect_editable',
							name: 'layout_template',
							editOnly: this.theme.get('developerMode'),
							protectedValue: '/themes/'+this.theme.get('id')+'/design/layout.twig'
						},{
							fieldLabel: _('Главный CSS'),
							xtype: 'fileselect_editable',
							name: 'css_main',
							beautify: true,
							minify: true,
							editOnly: this.theme.get('developerMode'),
							protectedValue: '/themes/'+this.theme.get('id')+'/css/style.css'
						}
						,{
							fieldLabel: _('Левая колонка каталога'),
							xtype: 'fileselect_editable',
							name: 'left_column_template',
							beautify: true,
							minify: true,
							editOnly: this.theme.get('developerMode'),
							protectedValue: '/themes/'+this.theme.get('id')+'/design/block_left_column.twig'
						}				
						,{
							xtype: 'fieldset',
							title: _('Шаблоны страниц'),
							collapsible: false,
							defaults: {
								labelWidth: 140,
								anchor: '100%',
								getFileSuffix: function() {
									var form = this.up('form');
									return form.getFileSuffix();
								}
							},            
							items: [
							
								{
									fieldLabel: _('Главная страница'),
									xtype: 'fileselect_editable',
									name: 'index_template',
									editOnly: this.theme.get('developerMode'),
									protectedValue: '/themes/'+this.theme.get('id')+'/design/page_index.twig'
								},{
									fieldLabel: _('Страница каталога'),
									xtype: 'fileselect_editable',
									name: 'catalog_template',
									editOnly: this.theme.get('developerMode'),
									protectedValue: '/themes/'+this.theme.get('id')+'/design/page_catalog.twig'
								},{
									fieldLabel: _('Страница корзины'),
									xtype: 'fileselect_editable',
									name: 'cart_template',
									editOnly: this.theme.get('developerMode'),
									protectedValue: '/themes/'+this.theme.get('id')+'/design/page_cart.twig'
								},{
									fieldLabel: _('Страница заказа'),
									xtype: 'fileselect_editable',
									name: 'order_template',
									editOnly: this.theme.get('developerMode'),
									protectedValue: '/themes/'+this.theme.get('id')+'/design/page_order.twig'
								},{
									fieldLabel: _('Страница раздела'),
									xtype: 'fileselect_editable',
									name: 'section_template',
									editOnly: this.theme.get('developerMode'),
									protectedValue: '/themes/'+this.theme.get('id')+'/design/page_section.twig'
								},{
									fieldLabel: _('Страница поиска'),
									xtype: 'fileselect_editable',
									name: 'search_template',
									editOnly: this.theme.get('developerMode'),
									protectedValue: '/themes/'+this.theme.get('id')+'/design/page_search.twig'
								},{
									fieldLabel: _('Страница новостей'),
									xtype: 'fileselect_editable',
									name: 'news_template',
									editOnly: this.theme.get('developerMode'),
									protectedValue: '/themes/'+this.theme.get('id')+'/design/page_news.twig'
								}		
							
							]
						}
							
					] 			
				},{
					title: _('Коды и счетчики'),
					defaults: {
						labelWidth: 120,
						anchor: '100%'
					},

					layout: {
						type: 'vbox',
						align: 'stretch'  // Child items are stretched to full width
					},			
					items: [
						{
							fieldLabel: _('Код в HEAD'),
							xtype: 'acefield',
							flex: 1,
							name: 'code_head'
						},{
							xtype: 'panel',
							bodyStyle:'background: none',
							border: false,
							html: '<p style="font-size:90%; margin: 0 0 10px 130px">'+_('Код будет добавлен внутри тега')+' &lt;HEAD&gt;</p>'
						},{
							fieldLabel: _('Код счетчиков'),
							xtype: 'acefield',
							flex: 1,
							name: 'code_footer'
						}
							
					] 			
				}]
			}
		});
		
		this.callParent();
		
	}			
});  