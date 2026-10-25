Ext.define('Plugin.partner.Panel', {
    extend: 'Ext.Panel',

    bodyCls: 'x-window-body-default',        
    cls: 'x-window-body-default',
    style: 'border: none',
    border: false,
    padding: 10,

    tpl: [
			'<p>Вы можете привлекать партнеров для регистрации сайта, используя ссылку <a href="{partner_link}" target="_blank">{partner_link}</a></p>',
			'<p>За каждого привлеченного партнера вы будете получать определенный %</p>',
            '<p>Ваш текущий баланс: <strong>{balance} р.</strong></p>',
			'<table border="1" style="background:#fff; border-collapse:collapse" cellpadding="4"><tr><th>Дата</th><th>Операция</th><th>Сумма</th></tr>',
            '<tpl for="transactions">',
                '<tr><td>{date}</td><td>{comment}</td><td style="text-align:right;">{amount}</td></tr>',
            '</tpl></p>',			
			'</table>'
    ],	
	
	html: 'Загрузка данных ...',

	initComponent: function() {
		
		
		this.on('afterrender', function() {
					
			Ext.Ajax.request({
				url: '/plugins/partner/info.php',
				scope: this,
				success: function(resp) {
					var obj = Ext.decode(resp.responseText);
					this.update(obj);					
				}
			});			
		
		}, this);
		
		this.callParent();
		
	}
	
});