/**
 * @category        modules
 * @package         wysiwyg
 * @author          WebsiteBaker Project, Michael Tenschert
 * @copyright       2010, Michael Tenschert
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/lgpl.html
 */
CKEDITOR.dialog.add( 'WBLinkDlg', function( editor ) {
    return { 
        title: 'WB Link - Insert WebsiteBaker Link',
        minWidth: 300,
        minHeight: 300,
        contents: [ 
            {
                id: 'iframe',
                label: 'WB Links',
                expand : true,
                title: 'Tab1',
                elements : [{
                        type: 'iframe',
                        src : '../../modules/ckeditor/ckeditor/plugins/wblink/dialogs/wblink.php',
                        width : '100%',
                        height : '100%',
                        onContentLoad : function() {
                        }
                    },] 
            }
            ],
         onOk: function() {
         },
         resizable: 3
    };
} );