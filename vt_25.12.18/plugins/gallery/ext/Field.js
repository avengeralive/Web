Ext.define('Plugin.gallery.Field', {

    extend: 'Cetera.field.RichMatSet',
    
    getPanel : function() {
    
        var panel = this.callParent();
        var tb = panel.getDockedComponent( 0 );

        tb.add({
            tooltip: 'Загрузить из ZIP',
            icon: '/plugins/gallery/icon-zip.png',
            handler: this.onArchive,
            scope: this
        });
        return panel;
    },
    
    onArchive: function() {
        if (!this.uploadWindow) {
        
            this.uploadWindow = Ext.create('Cetera.window.Upload', { 
                showPath: false,
                path: '/uploads/' 
            });
            
            this.uploadWindow.on('successUpload', function(info) {
                var file = info.path + info.file;

                Ext.Ajax.request({
                    url: '/plugins/gallery/action_unzip.php',
                    params: { file: file, mat_type: this.mat_type },
                    scope: this,
                    success: function(resp) {

                        var obj = Ext.decode(resp.responseText);
                        for (var i=0; i<obj.files.length; i++) { 
                            
                            var item = Ext.create('Cetera.RichMatsetMaterial' + this.mat_type);
                            item.material_id = obj.files[i].id;
                            item.getForm().setValues(obj.files[i]);
                            this.panel.add(item);                            
                            
                        }

                    }
                });

            }, this);            
            
        }
        this.uploadWindow.show();
    }          
    
});