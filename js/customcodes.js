// JavaScript Document
(function() {
    tinymce.create('tinymce.plugins.plus1', {
        init : function(ed, url) {
            ed.addButton('plus1', {
                title : 'Google +1 Button',
                image : url+'/plus1_icon.jpg',
                onclick : function() {
                     ed.selection.setContent('[plus1 count="true" size="standard"]' + ed.selection.getContent() + '[/plus1]');
 
                }
            });
        },
        createControl : function(n, cm) {
            return null;
        },
    });
    tinymce.PluginManager.add('plus1', tinymce.plugins.plus1);
})();