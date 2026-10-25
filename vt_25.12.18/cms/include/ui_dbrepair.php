<?php
namespace Cetera;
header('Content-Type: application/javascript; charset=UTF-8');
include('../include/common_bo.php');
?>
Ext.define('RepairPanel', {

    extend:'Ext.Panel',
        
    bodyCls: 'x-window-body-default',        
    cls: 'x-window-body-default',
    style: 'border: none',
    border: false,
    padding: 10,
    
    layout: {
        type: 'hbox',
        align : 'stretch',
        pack  : 'start'
    },    

    initComponent : function() {
    
        this.panel = new Ext.Panel({
            bodyCls: 'x-panel-body',
            padding: 5,
            bodyStyle: 'padding: 10px',
            flex: 1
        });
        
        this.form = new Ext.form.FormPanel({
        fieldDefaults : { 
            labelWidth: 1
        },
            bodyStyle: 'background: none',
            border: false,
            height: 100,
            items : [{
                boxLabel: '<?=$translator->_('анализировать структуру БД')?>',
                name: 'db_structure',
                xtype: 'checkbox',
                checked: true,
                inputValue: 1
            },{
                labelWidth: 21,
                bodyStyle: 'background: none; padding: 10px',
                border: false,
                items: [{
                    boxLabel: '<?=$translator->_('игнорировать лишние поля в таблицах')?>',
                    name: 'ignore_fields',
                    xtype: 'checkbox',
                    checked: true,
                    inputValue: 1
                },{
                    boxLabel: '<?=$translator->_('игнорировать лишние индексы в таблицах')?>',
                    name: 'ignore_keys',
                    xtype: 'checkbox',
                    inputValue: 1
                }]
            }/*,{
                boxLabel: '<?=$translator->_('анализировать структуру разделов')?>',
                name: 'cat_structure',
                xtype: 'checkbox',
                checked: true,
                inputValue: 1
            }*/]
        });
        
        this.btnCheck = new Ext.Button({
            text: '<?=$translator->_('Анализировать')?>',
            scope: this,
            handler: this.check
        });
        
        this.btnRepair = new Ext.Button({
            text: '<?=$translator->_('Исправить обнаруженные ошибки')?>',
            hidden: true,
            scope: this,
            handler: this.fix
        });
           
        this.items = [this.form,this.panel];
        
        this.fbar = {layout:{pack:'left'}, items:[this.btnCheck , this.btnRepair]};
           
        this.callParent();

    },
    
    check: function() {
        this.btnRepair.hide();
        this.form.getForm().submit({
            url:'include/action_check.php', 
            waitMsg:'<?=$translator->_('Подождите ...')?>',
            scope: this,
            success: function(form, action) {
                this.panel.update('Ошибок не обнаружено.');
            },
            failure: function(form, action) {
                this.panel.update(action.result.text);
                this.btnRepair.show();
            }
        });    
    },
    
    fix: function() {
        this.btnRepair.hide();  
        this.form.getForm().submit({
            url:'include/action_fix.php', 
            waitMsg:'<?=$translator->_('Подождите ...')?>',
            scope: this,
            success: function(form, action) {
                this.panel.update(action.result.text);
            },
            failure: function(form, action) {
                this.panel.update(action.result.text);
            }
        });        
    }    

});
