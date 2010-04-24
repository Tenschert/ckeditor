/*
* WARNING: Clear the cache of your browser cache after you modify this file!
* If you don't do this, you may notice that your browser is ignoring all your changes.
*
* --------------------------------------------------
*
* Note: The following CKEditor configs are set in _yourwb_/modules/ckeditor/include.php
* 
* Example: "$ckeditor->config['uiColor']" is PHP code in include.php. The very same here in the 
* wb_ckconfig.js would be: "config.uiColor" inside CKEDITOR.editorConfig = function( config ). 
* 
* // The CSS file to be used to apply style to the textarea. It's "The WebsiteBaker editor.css"
* --> config.contentsCss <--
* 
* // The Styles dropdown in the editor. In FCKEditor that was a XML file (fckstyles.xml)
* // In CKEditor we use JavaScript - per default it's "editor.styles.js" - there's also more help.
* --> config.stylesSet <--
* 
* // The Templates list ("presets" like two columns with a picture) in the editor. In FCKEditor that was 
* // a XML file (fcktemplates.xml).
* / In CKEditor we use JavaScript - per default it's "editor.templates.js" - there's also more help.
* --> config.templates <-- // The templates definition set to use. It accepts a comma separated list.
* --> config.templates_files <-- // The list of templates definition files to load. 
* 
*/

CKEDITOR.editorConfig = function( config )
{
    // The standard color of CKEditor. Can be changed in any hexadecimal color you like. Use the     
    // UIColor Plugin in your CKEditor to pick the right color.
    config.uiColor                  = '#bcd5eb';
    
    // Both options are for XHTML 1.0 strict compatibility
    // config.indentClasses            = [ 'indent1', 'indent2', 'indent3', 'indent4' ];
    // [ Left, Center, Right, Justified ] 
    // config.justifyClasses           = [ 'left', 'center', 'right', 'justify' ];
    
    config.templates_replaceContent =   true;
    // Define all extra CKEditor plugins in _yourwb_/modules/ckeditor/ckeditor/plugins here
    config.extraPlugins             = 'wbdroplets,wblink,uicolor';
    
    // Different Toolbars. Remove, add or move 'SomeButton', with the quotes and following comma 
    config.toolbar_Full     = [['Source','-','Save','NewPage','Preview','-','Templates'],['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print','SpellChecker','Scayt'],['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],['Maximize','ShowBlocks','-','UIColor','About'],'/',['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['wbdroplets','wblink','Link','Unlink','Anchor'],['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],'/',['Styles','Format','Font','FontSize'],['TextColor','BGColor']];
    config.toolbar_WB_Basic     = [['Source','Preview'],['Cut','Copy','Paste','PasteText','PasteFromWord'],['Image','Flash','Table','HorizontalRule'],['wbdroplets','wblink','Link','Unlink','Anchor'],['Undo','Redo','-','SelectAll','RemoveFormat'],['Maximize','ShowBlocks','-','UIColor','About'],'/',['Styles','Format','Font','FontSize'],['TextColor','BGColor'],['Bold','Italic','Underline','Strike'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv']];
    config.toolbar_WB_Full     = [['Source','-','Preview','Templates'],['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print','SpellChecker','Scayt'],['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],['Maximize','ShowBlocks','-','UIColor','About'],'/',['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['wbdroplets','wblink','Link','Unlink','Anchor'],['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar'],'/',['Styles','Format','Font','FontSize'],['TextColor','BGColor']];
    config.toolbar_Basic    = [['Bold','Italic','-','NumberedList','BulletedList','-','Link','Unlink','-','About']];
    
    // The default toolbar. Default: WB_Full
    config.toolbar          = 'WB_Full';
    
    // Explanation: _P: new <p> paragraphs are created; _BR: lines are broken with <br> elements;
    //              _DIV: new <div> blocks are created.
    // Sets the behavior for the ENTER key. Default is _P allowed tags: _P | _BR | _DIV
    config.enterMode        = CKEDITOR.ENTER_P; 
    // Sets the behavior for the Shift + ENTER keys. allowed tags: _P | _BR | _DIV
    config.shiftEnterMode   = CKEDITOR.ENTER_BR; 
    
    // Allows to force CKEditor not to localize the editor to the user language. Default: Empty (''); Example: ('fr') for French.
    config.language         = ''; 
    // The language to be used if config.language is empty and it's not possible to localize the editor to the user language.
    config.defaultLanguage  = 'en'; 
    config.docType          = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    
    // The skin to load. It may be the name of the skin folder inside the editor installation path,  
    // or the name and the path separated by a comma. 
    config.skin             = 'kama';
    
    // The standard height and width of CKEditor in pixels.
    config.height           = '250';
    config.width            = '900';
    config.toolbarLocation  = 'top';
    
    // Define possibilities of automatic resizing in pixels. Set config.resize_enabled to false to 
    // deactivate resizing.
    config.resize_enabled   = true;
    config.resize_minWidth  = 500;
    config.resize_maxWidth  = 1500;
    config.resize_minHeight = 200;
    config.resize_maxHeight = 1200;

    // ---------- Filebrowser ----------
    
    //config.filebrowserBrowseUrl = '../../admin/media/browse.php';
    //config.filebrowserUploadUrl = '../../admin/media/upload.php';
    //config.filebrowserWindowWidth   = '800';
    //config.filebrowserWindowHeight  = '500';
    
    // Protect PHP code tags (<?...?>) so CKEditor will not break them when switching from Source to WYSIWYG.
    // Uncommenting this line doesn't mean the user will not be able to type PHP code in the source. This         // kind of prevention must be done in the server side, so just leave this line as is.
    config.protectedSource.push(/<\?[\s\S]*?\?>/g); // PHP Code
};