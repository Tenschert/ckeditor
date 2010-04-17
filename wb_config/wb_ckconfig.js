/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig       = function( config )
{
    config.uiColor          = '#bcd5eb';
    config.contentsCss      = '../../modules/ckeditor/wb_config/contents.css';
    
    config.indentClasses    = [ 'indent1', 'indent2', 'indent3', 'indent4' ];
    config.justifyClasses   = [ 'left', 'center', 'right', 'justify' ];
    // [ Left, Center, Right, Justified ] Both options are for XHTML 1.0 strict compatibility
    
    config.extraPlugins     = 'WBDroplets,WBModules,uicolor';
    config.toolbar_Full     = [['Source','-','Save','NewPage','Preview','-','Templates'],['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print','SpellChecker','Scayt'],['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],'/',['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'],['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],['WBDroplets','WBModules','Link','Unlink','Anchor'],['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'],'/',['Styles','Format','Font','FontSize'],['TextColor','BGColor'],['Maximize','ShowBlocks','-','UIColor','About']];
    config.toolbar_Basic    = [['Bold','Italic','-','NumberedList','BulletedList','-','Link','Unlink','-','About']];
    
    config.enterMode        = CKEDITOR.ENTER_P; // Sets the behavior for the ENTER key. Default is _P allowed tags: _P | _BR | _DIV
    config.shiftEnterMode   = CKEDITOR.ENTER_BR; // allowed tags: _P | _BR | _DIV
                // Explanation: _P: new <p> paragraphs are created; _BR: lines are broken with <br> elements;_DIV: new <div> blocks are created.
    config.language         = ''; // Allows to force CKEditor not to localize the editor to the user language. Default: Empty (''); Example: ('fr') for French.
    config.defaultLanguage  = 'en'; // The language to be used if config.language is empty and it's not possible to localize the editor to the user language.
    config.docType          = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
    
    config.height           = '250';
    config.width            = '900';
    config.toolbarLocation  = 'top';
    
    // Define possibilities of automatic resizing (Sizes are always in Pixels)
    config.resize_enabled   = true;
    config.resize_minWidth  = 500;
    config.resize_maxWidth  = 1500;
    config.resize_minHeight = 200;
    config.resize_maxHeight = 1200;

    // ######### Filebrowser ############
    config.filebrowserBrowseUrl     = '../../admin/media/browse.php',
    //config.filebrowserUploadUrl   = '../../../templates/wb_theme/templates/media_browse.htt',
    config.filebrowserUploadUrl     = '../../admin/media/upload.php',
    config.filebrowserWindowWidth   = '800',
    config.filebrowserWindowHeight  = '500',
    
    // Protect PHP code tags (<?...?>) so CKEditor will not break them when switching from Source to WYSIWYG.
    // Uncommenting this line doesn't mean the user will not be able to type PHP code in the source. This         // kind of prevention must be done in the server side, so just leave this line as is.
    config.protectedSource.push(/<\?[\s\S]*?\?>/g); // PHP Code
};