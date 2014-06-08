// Creates a new plugin class
tinymce.create('tinymce.plugins.testPlugin', {
    init : function(ed, url) {
        // Register the command so that it can be invoked by using tinyMCE.activeEditor.execCommand('mcetest');
        ed.addCommand('hcv_upload', function() {
            ed.windowManager.open({
                file : url + '/index.php',
                width : 900 + ed.getLang('test.delta_width', 0),
                height : 520 + ed.getLang('test.delta_height', 0),
                inline : 1
            }, 
            {
                plugin_url : url, // Plugin absolute URL
                some_custom_arg : 'custom arg' // Custom argument
            }
            
            )
            
            
        });

        // Register test button
        ed.addButton('hcv_upload', {
            title : 'Upload',
            cmd : 'hcv_upload',
            image : url + '/img/hcv_upload.gif'
        });

        // Add a node change handler, selects the button in the UI when a image is selected
        ed.onNodeChange.add(function(ed, cm, n) {
            cm.setActive('hcv_upload', n.nodeName == 'IMG');
        });
    },
    
    createControl:function(b,a){return null},
    getInfo:function(){
            return{
                longname:"Example plugin",
                author:"Some author",
                authorurl:"http://tinymce.moxiecode.com",
                infourl:"http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example",
                version:"1.0"}
            }
});

// Register plugin
tinymce.PluginManager.add('hcv_upload', tinymce.plugins.testPlugin);