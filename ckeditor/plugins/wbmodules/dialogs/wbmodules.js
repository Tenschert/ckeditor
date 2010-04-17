/**
 * @category        modules
 * @package         wysiwyg
 * @author          WebsiteBaker Project, Michael Tenschert
 * @copyright       2010, Michael Tenschert
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/lgpl.html
 */
CKEDITOR.dialog.add( 'WBModulesDlg', function( editor ) {
    return { 
        title: 'WB Link - Insert WebsiteBaker Link',
        minWidth: 300,
        minHeight: 300,
        contents: [ 
            {
                id: 'iframe',
                label: 'WB Modules',
                expand : true,
                title: 'Tab1',
                elements : [{
                        type: 'iframe',
                        src : 'http://localhost/web/wbtemp/modules/ckeditor/ckeditor/plugins/wbmodules/dialogs/wbmodules.php',
                        width : '100%',
                        height : '100%',
                        onContentLoad : function() {
                            var iframe = document.getElementById( this._.frameId );
                            iframeWindow = iframe.contentWindow;
                        }
                    },] 
            }
            ],
         onOk: function() {
             this._.editor.insertHtml(iframeWindow.getElementById('test').value);
         },
         resizable: 3
    };
} );