/**
 * @category        modules
 * @package         wysiwyg
 * @author          WebsiteBaker Project, Michael Tenschert
 * @copyright       2010, Michael Tenschert
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/lgpl.html
 */
 
CKEDITOR.dialog.add( 'WBDropletsDlg', function( editor ) {
    return { 
        title: editor.lang.wbdroplets.name,
        minWidth: 300,
        minHeight: 300,
        contents: [ 
            {
                id: 'tab1',
                label: 'WB Droplets',
                expand : true,
                title: 'Tab1',
                elements : [{
                        type: 'iframe',
                        src : '../../modules/ckeditor/ckeditor/plugins/wbdroplets/dialogs/wbdroplets.php',
                        width : '100%',
                        height : '100%',
                        onContentLoad : function() {
                        }
                    },] 
            }
            ],
         onOK: function() {
         },
         resizable: 3
    };
} );