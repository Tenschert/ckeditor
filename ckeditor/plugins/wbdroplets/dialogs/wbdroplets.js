/**
 * @category        modules
 * @package         wysiwyg
 * @author          WebsiteBaker Project, Michael Tenschert
 * @copyright       2010, Michael Tenschert
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/lgpl.html
 */
 /*
 From fck_wbdroplets.htt
 -------------------------------
 var oEditor            = window.parent.InnerDialogLoaded(); 
            var FCK                = oEditor.FCK; 
            var FCKLang            = oEditor.FCKLang ;
            var FCKConfig        = oEditor.FCKConfig ;
            //var FCKCMSCCMSModules    = oEditor.FCKCMSModules; 
             
            // oLink: The actual selected link in the editor.
            var oLink = FCK.Selection.MoveToAncestorNode( 'A' ) ;
            if ( oLink )
                FCK.Selection.SelectNode( oLink ) ;
    
            window.onload = function ()    { 
                // First of all, translates the dialog box texts.
                oEditor.FCKLanguageManager.TranslatePage(document);
                
                window.parent.SetOkButton( true );        //Show the "Ok" button. 
                
            } 
             
            //If an anchor (A) object is currently selected, load the properties into the dialog 
            function LoadSelected()    {
                var sSelected;
                
                if ( oEditor.FCKBrowserInfo.IsGecko ) {
                    sSelected = FCK.EditorWindow.getSelection();
                } else {
                    sSelected = FCK.EditorDocument.selection.createRange().text;
                }
            }

            //Code that runs after the OK button is clicked 
            function Ok() {
                //Validate is option is selected
                var oDropletList = document.getElementById( 'cmbDroplets' ) ;
                if(oDropletList.selectedIndex == -1) {
                    alert( FCKLang.WBDropletsErrPageSelect );
                    return false;
                }
                
                var oTagLink = document.getElementById( 'chkTaglink' );
                
                var sDropletStr = oDropletList[oDropletList.selectedIndex].value;
                FCK.InsertHtml("[[" + sDropletStr + "]]");
                // the following line was commented out as it creates an error message in some browser (e.g. IE)
                // even Firefox seems not to make use of the title so we remove this option for know (doc)
                // SetAttribute( oLink, 'title', document.getElementById( 'txtTitle' ).value ) ;
            return true;

            }
            
            var oldid = 'LoginBox';
            
            function showdetail(obj) {
                var olditem = document.getElementById(oldid);
                var newitem = document.getElementById(obj.value);
                olditem.className='hidden'; // jQuery!!!!
                newitem.className='unhidden'; // jQuery!!!!
                oldid = obj.value;
            }
 -------------------------------
 */
CKEDITOR.dialog.add( 'WBDropletsDlg', function( editor ) {
    return { 
        title: editor.lang.wbdroplets.name,
        minWidth: 300,
        minHeight: 300,
        contents: [ 
            {
                id: 'iframe',
                label: 'WB Droplets',
                expand : true,
                title: 'Tab1',
                elements : [{
                        type: 'iframe',
                        src : '../../modules/ckeditor/ckeditor/plugins/wbdroplets/dialogs/wbdroplets.php',
                        width : '100%',
                        height : '100%',
                        onContentLoad : function() {
                            var iframe = document.getElementById( this._.frameId );
                            iframeWindow = iframe.contentWindow;
                        }
                    },] 
            }
            ],
         onOK: function() {
             CKEDITOR.dialog.getCurrent().getValueOf("info", "txtUrl")
             this._.editor.insertHtml(iframeWindow.getElementById('cmbDroplets').value);
             if(oDropletList.selectedIndex == -1) {
                    alert( WBDropletsErrPageSelect );
                    return false;
             }
         },
         resizable: 3
    };
} );