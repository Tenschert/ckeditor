/*
 #########################################################################################
 # Configure CKEditor according your needs
 # ---------------------------------------------------------------------------------------
 #  Purpose of this file is to define all settings of CKEditor without changing the CK
 #  Javascript core file CKconfig.js. Doing so allows to upgrade to a newer version of
 #  CKEditor while keeping all your customisations (styles, toolbars...)
 #  
 #  Author: Christian Sommer, (doc)
 #
 #  Follow this link for more information:
 #  http://wiki.CKeditor.net/Developer%27s_Guide/Configuration/Configurations_Settings
 #  
 #########################################################################################
*/

// required settings to make CKEditor work with Website Baker (do not change them)
    CKConfig.Plugins.Add( 'WBModules', 'en,nl,de' ) ;
    CKConfig.Plugins.Add( 'WBDroplets', 'en,nl,de' ) ;
//  CKConfig.Plugins.Add( 'youtube', 'en,ja,de' );
    CKConfig.Plugins.Add( 'swfobject', 'en,es') ;
//  CKConfig.Plugins.Add( 'flvPlayer','en,de') ;

// ----------------------
// Configure Syntax highlighter for 2.0.x
CKConfig.Plugins.Add('syntaxhighlight2', 'en');
// default language options:
// c++,csharp,css,delphi,java,jscript,php,python,ruby,sql,vb,xhtml
CKConfig.SyntaxHighlight2LangDefault = 'php';
//
// ----------------------

// CKConfig.Plugins.Add( 'autogrow' ) ;
// CKConfig.Plugins.Add( 'dragresizetable' );
CKConfig.AutoGrowMax = 600 ;

// CKConfig.ProtectedSource.Add( /<%[\s\S]*?%>/g ) ;	// ASP style server side code <%...%>
// CKConfig.ProtectedSource.Add( /<\?[\s\S]*?\?>/g ) ;	// PHP style server side code
// CKConfig.ProtectedSource.Add( /(<asp:[^\>]+>[\s|\S]*?<\/asp:[^\>]+>)|(<asp:[^\>]+\/>)/gi ) ;	// ASP.Net style tags <asp:control>

// #########################################################################################
// # CKEditor: General settings
// # ---------------------------------------------------------------------------------------
// #  Here you can modify all the options available in the /CKeditor/editor/CKconfig.js
// #  Settings defined here will overrule the ones defined in CKconfig.js without touching
// #  the Javascript core files of CK.
// #
// #  If you are missing some options, have a look into CKconfig.js and copy the required
// #  code lines here
// #########################################################################################

// set doctype as used in your template to prevent code mix up (example XHTML 1.0 Transitional)
   CKConfig.DocType = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' ;

// define CK default language
   CKConfig.AutoDetectLanguage		= true ;	// could be turned off, if all users speek same language
   CKConfig.DefaultLanguage		= 'en' ;	// could be switched to de for German
   CKConfig.ContentLangDirection	= 'ltr' ;	// left to right

// specify HTML tag used for ENTER and SHIFT+ENTER key
   CKConfig.EnterMode 			= 'p' ;		// allowed tags: p | div | br
   CKConfig.ShiftEnterMode 	= 'br' ;	// allowed tags: p | div | br
   CKConfig.StylesXmlPath		= CKConfig.EditorPath + 'CKstyles.xml' ;
 
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// Note: If you miss some options, have a look into CKconfig.js and add the lines below
// +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


// #########################################################################################
// # CKEditor: Customised CKEditor tool bar
// # ---------------------------------------------------------------------------------------
// #  Here you can modify the CKEditor tool bar to your needs.
// #  A collection of example layouts are provided below.
// #
// #  Note: Per default the tool bar named: "WBToolbar" will be used within CKEditor.
// #########################################################################################

// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//  Default toolbar set used by Website Baker
// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
   CKConfig.ToolbarSets["Original"] = [
	['Source','Save'],
	['Cut','Copy','Paste','PasteText','PasteWord','-','SpellCheck'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	['Smiley','SpecialChar'],
	['FitWindow','-','About'],
	'/',
	['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
	['OrderedList','UnorderedList','-','Outdent','Indent'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
	['Link','Unlink','Anchor'],
	['Image','Flash','Table','Rule'],
	'/',
	['Style','FontFormat','FontName','FontSize'],
	['TextColor','BGColor']
] ;

// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//  original CKEditor toolbar
// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
   CKConfig.ToolbarSets["WBToolbar"] = [
	['Source','DocProps','-','NewPage','Preview','-','Templates'],
	['Cut','Copy','Paste','PasteText','PasteWord','-','Print','SpellCheck'],
    ['FitWindow','ShowBlocks', '-', 'SyntaxHighLight2', /* 'flvPlayer', */ '-','About'],
	'/',
	['Form','Checkbox','Radio','TextField','Textarea','Select','Button','ImageButton','HiddenField'],
    ['TextColor','BGColor'],
	['WBDroplets','WBModules','Link','Unlink','Anchor'],
	['Image','Flash','Table','Rule','Smiley','SpecialChar','PageBreak'],
	'/',
	['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
	['OrderedList','UnorderedList','-','Outdent','Indent','Blockquote'],
	['JustifyLeft','JustifyCenter','JustifyRight','JustifyFull'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	'/',
	['Style','FontFormat','FontName','FontSize']  // No comma for the last row.

] ;


// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
//  simple toolbar (only basic functions)
// ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
   CKConfig.ToolbarSets["Simple"] = [
	['Preview',"Print"],
	['Cut','Copy','Paste','PasteText'],
	['Undo','Redo'],
	['Bold','Italic','Underline'],
	['OrderedList','UnorderedList','-','Table'],
	['WBModules','Link','Unlink','Anchor'],
	['RemoveFormat','Image','-','Source'],
	'/',
	['FontFormat','Style']
] ;


// #########################################################################################
// # CKEditor: CSS / XML / TEMPLATES
// # ---------------------------------------------------------------------------------------
// #  Here you can tweak the layout of the CKEditor according your needs.
// #  Specify HTML elements shown in the dropdown menu and the XML file which defines your
// #  CSS styles available in the CKEditor style menu.
// #########################################################################################

// define HTML elements which appear in the CK "Format" toolbar menu
   CKConfig.FontFormats	= 'p;div;pre;address;h1;h2;h3;h4;h5;h6' ;
// define font colors which can be set by the user (HEXADECIMAL)
   CKConfig.FontColors = '000000,993300,333300,003300,003366,000080,333399,333333,800000,FF6600,808000,808080,008080,0000FF,666699,808080,FF0000,FF9900,99CC00,339966,33CCCC,3366FF,800080,999999,FF00FF,FFCC00,FFFF00,00FF00,00FFFF,00CCFF,993366,C0C0C0,FF99CC,FFCC99,FFFF99,CCFFCC,CCFFFF,99CCFF,CC99FF,FFFFFF' ;
// define fonts style and sizes which can be set by the user
   CKConfig.FontNames	= 'Arial;Comic Sans MS;Courier New;Tahoma;Times New Roman;Verdana;Wingdings' ;
//   CKConfig.FontSizes	= 'smaller;larger;xx-small;x-small;small;medium;large;x-large;xx-large' ;
   CKConfig.FontSizes	= '8px;10px;12px;14px;16px;18px;20px;24px;28px;32px;36px;48px;60px;72px' ;
// make the offic2003 skin the default skin
   CKConfig.SkinPath = CKConfig.BasePath + 'skins/office2003/'
   CKConfig.ProtectedSource.Add( /<\?[\s\S]*?\?>/g ) ;
   CKConfig.TemplateReplaceAll = false;
   CKConfig.TemplateReplaceCheckbox = true ;
   CKConfig['StylesXmlPath'] = CKConfig.BasePath+'/wb_config/wb_CKstyles.xml';

/*
   -----------------------------------------------------------------------------------------
   Note: GENERAL HINTS ON CSS FORMATS AND XML FILES
   -----------------------------------------------------------------------------------------
   Easiest way to display all CSS definitions used in your template is to make a copy of your
   CSS definition file and place it as "editor.css" in your template folder.
   All styles will automatically be updated and used with the CK editor.

   If you don´t want to put custom "editor.css" files into your templates folder, you can
   try the other approach introduced below:
   
   copy all CSS definitions of your template into file: /my_config/my_CKeditorarea.css
    o Default HTML elements like (h1, p) will appear in the format you have specified via CSS.
    o additional HTML elements like (.title) will appear in the "Styles" toolbar menu of CK
   
   Via file (/my_config/my_CKstyles.xml) you can define additional styles for default
   elements. Use this option, if you want to display conditional styles only if a special
   HTML element is selected (e.g. after selecting an <img> element, the style menu will
   provide additional elements like align=left, align=right, which don´t show up for other
   elements like <p>

   CSS definitions declared in the XML file are realised as INLINE styles. If you want avoid
   INLINE elements, but the CSS definitions into the /my_config_my_CKeditorarea.css and
   references only the class or ID in the XML file.

   Use /my_config/my_template.xls to define custom Editor templates (e.g. 2 or 3 column).
   This option is usefull if you have several side layouts (e.g. Level 1, Level 2...)
*/


// #########################################################################################
// # CK Editor: PLUGINS (Link, Image, Flash)
// # ---------------------------------------------------------------------------------------
// #  Plugin Link:   create internal or external links and URL
// #  Plugin Image:  insert images to your WYSIWYG text area form the WB media directory
// #  Plugin Flash:  insert flash elements including upload Option
// #  
// #  Note: 
// #  You need to integrate the plugins into the menu bar so you can use them
// #    CKConfig.ToolbarSets["MyToolbar"] = [
// #      ['Image',Link','Flash'], ...
// #    ];
// #########################################################################################

// configure the image plugin
   CKConfig.ImageUpload = false ;		// display/hides image upload tab (allow/disable users to upload images from CK)
   CKConfig.ImageBrowser = true ;		// enables/disables the file browser to search for uploaded files in /media folder

// configure the link plugin
   CKConfig.LinkUpload = false ;		// display/hides link upload tab (allow/disable users to upload files from CK)
   CKConfig.LinkBrowser = true ;		// enables/disables the file browser to search for uploaded files in /media folder

// configure the flash plugin
   CKConfig.FlashUpload = false ;		// display/hides upload tab (allow/disable users to upload flash movies from CK)
   CKConfig.FlashBrowser = true;		// enables/disables the file browser to search for uploaded files in /media folder