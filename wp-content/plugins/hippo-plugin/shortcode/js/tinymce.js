    /*------------------------------------*\

     Name: tinymce.js
     Author: Theme Hippo
     Author URI: http://www.themehippo.com
     Version: 0.1

     \*------------------------------------*/

jQuery(function ($) {

    tinymce.create('tinymce.plugins.em_shortcode', {
        init: function (ed, url) {
            // Register command for when button is clicked
            ed.addCommand('em_action', function () {
                var mce_selected_contents = tinyMCE.activeEditor.selection.getContent();



                //tb_show(em_shortcode_obj.window_title, url + '/../includes/em-mce-popup.php?&width=640&height=300&content_dir='+em_shortcode_obj.wp_content_dir+'&abspath='+em_shortcode_obj.abspath);
                tb_show(em_shortcode_obj.window_title, url + '/../includes/em-mce-popup.php?&width=640&height=300&abspath='+em_shortcode_obj.abspath);

                //return false;
                 /*ed.windowManager.open({
                 title  : em_shortcode_obj.window_title,
                 url    : url + '/../includes/em-mce-popup.php',
                 //width  : parseInt(em_shortcode_obj.width),
                 width  : parseInt( $(window).innerWidth()-100 ),
                 //height : parseInt(em_shortcode_obj.height),
                 height : parseInt($(window).innerHeight()-100),
                 inline : 0
                 }, {});*/


                /*ed.windowManager.open({
                    // Modal settings
                    title: em_shortcode_obj.window_title,
                    width: jQuery( window ).width() * 0.7,
                    // minus head and foot of dialog box
                    height: (jQuery( window ).height() - 36 - 50) * 0.7,
                    //height: 'auto',
                    //wpDialog : true,
                    inline: 1,
                    id: 'plugin-slug-insert-dialog',
                    buttons: [{
                                  text: 'Insert',
                                  id: 'plugin-slug-button-insert',
                                  class: 'insert button-primary button-large',
                                  onclick: function( e ) {
                                      insertShortcode();
                                  }
                              },
                              {
                                  text: 'Cancel',
                                  id: 'plugin-slug-button-cancel',
                                  onclick: 'close'
                              }],
                    onsubmit: function( e ) {
                        //editor.insertContent( '&lt;h3&gt;' + e.data.title + '&lt;/h3&gt;');
                    }
                });*/



                //tinymce.execCommand('mceInsertContent', false, data);
            });

            // Register buttons - trigger above command when clicked
            ed.addButton('em_button',
                {
                    title: em_shortcode_obj.button_title,
                    cmd: 'em_action',
                    //image: url + '/../images/em_shortcode.png' ,
                    icon: 'icon dashicons-carrot'
                });
        }
    });

    // Register our TinyMCE plugin
    // first parameter is the button ID1
    // second parameter must match the first parameter of the tinymce.create() function above
    tinymce.PluginManager.add('em_button', tinymce.plugins.em_shortcode);
});