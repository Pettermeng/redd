jQuery(document).ready(function($) {

    tinymce.create('tinymce.plugins.tfws_plugin', {
        init : function(ed, url) {
                // Register command for when button is clicked
                ed.addCommand('tfws_insert_shortcode', function() {
                    selected = tinyMCE.activeEditor.selection.getContent();
                    if( selected ){
                        //If text is selected when button is clicked
                        //Wrap shortcode around it.
                        content =  '[tfws username="'+selected+'" height="'+selected+'" width="'+selected+'" theme="'+selected+'" color="'+selected+'" tweets="'+selected+'" header="'+selected+'" footer="'+selected+'" borders="'+selected+'" scrollbar="'+selected+'" background="'+selected+'"]';
                    }else{
                        content =  '[tfws username="swadeshswain" height="700" width="350" theme="light" color="#FAB81E"  tweets="2" header="yes" footer="yes" borders="yes" scrollbar="yes" background="yes"]';
                    }
                    tinymce.execCommand('mceInsertContent', false, content);
                });
            // Register buttons - trigger above command when clicked
            ed.addButton('tfws_button', {title : 'Twitter Widget shortcode', cmd : 'tfws_insert_shortcode', image: url + '../../images/tfws-icon.png' });
        },   
    });
    // Register the TinyMCE plugin
    tinymce.PluginManager.add('tfws_button', tinymce.plugins.tfws_plugin);
});