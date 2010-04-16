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
        title: 'WB Link - Insert WebsiteBaker Droplet',
        minWidth: 150,
        minHeight: 300,
        contents: [ 
            {
                id: 'tab1',
                label: 'Tab1',
                title: 'Tab1',
                elements : [{
                        id: 'wbdroplets',
                        type: 'text',
                        label: "Droplets",
                        validate : function() {}
                    },] 
            }
            ],
         onOk: function() {
             //Validate is option is selected
             var oDropletList = document.getElementById( 'cmbDroplets' ) ;
             if(oDropletList.selectedIndex == -1) {
                 alert( FCKLang.WBDropletsErrPageSelect );
                 return false;
             };
             var oTagLink = document.getElementById( 'chkTaglink' );
             var sDropletStr = oDropletList[oDropletList.selectedIndex].value;
             CK.InsertHtml("[[" + sDropletStr + "]]");
             return true;
         },
         resizable: 3
    };
} );