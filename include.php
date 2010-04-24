<?php
/**
*
* @category modules
* @package wysiwyg
* @author Michael Tenschert
* @author WebsiteBaker Project
* @copyright 2004-2009, Ryan Djurovich
* @copyright 2009-2010, Website Baker Org. e.V.
* @link http://www.websitebaker2.org/
* @license http://www.gnu.org/licenses/gpl.html
* @platform WebsiteBaker 2.8.x
* @requirements PHP 4.4.9 and higher
* @version $Id: $
* @filesource $HeadURL: $
* @lastmodified $Date: $
*
*/

// prevent this file from being accessed directly
if ( !defined('WB_PATH'))
{
die(header('Location: index.php'));
}

// Prevent mixing-up when moving from SourceCode to WYSIWYG and back
function reverse_htmlentities($mixed)
{
    $mixed = str_replace(array( '&gt;', '&lt;', '&quot;', '&amp;' ), array( '>', '<', '"', '&' ), $mixed);
    return $mixed;
}

function get_ck_template($sub = '/editor.css')
{
global $page_template;

    $default_tpl = WB_PATH.'/templates/'.DEFAULT_TEMPLATE.$sub;
    $template = $default_tpl = file_exists($default_tpl) ? $default_tpl : 'none';

    $pageid = ( isset ( $_GET['page_id'] ) && (int)$_GET['page_id'] ) ? intval($_GET['page_id']) : 0;
    // check if an editor.css file exists in the specified template directory of current page
    if ( isset ( $pageid ) && (int)$pageid > 0 )
    {
        // $sql = 'SELECT `template` FROM `'.TABLE_PREFIX.'pages` WHERE `page_id` = '.$pageid;
        // $template = $database->get_one($sql);
        $template = WB_PATH.'/templates/'.$page_template.$sub;
        $template = file_exists($template)
? str_replace(WB_PATH, WB_URL, $template)
: str_replace(WB_PATH, WB_URL, $default_tpl);
    } else {
     $template = 'none';
    }
return $template;
}

// For the editor.css we need to know if it exists and where it is
function get_css_template_name()
{
// returns the template name of the current displayed page
    $ck_css_template_dir = get_ck_template('/editor.css');
    if( $ck_css_template_dir == 'none' )
{
$ck_css_template_dir = get_ck_template('/css/editor.css');
}
    return $ck_css_template_dir;
}

// For the editor.styles.js we need to know if it exists and where it is
// returns the template name of the current displayed page
// work out default editor.styles.js file for CKEditor
function get_styles_template_name()
{
    $ck_styles_template_dir = get_ck_template('/editor.styles.js');
if( $ck_styles_template_dir == 'none' )
    {
        $ck_styles_template_dir = get_ck_template('/js/editor.styles.js');
    }
    return $ck_styles_template_dir;
}

function show_wysiwyg_editor($name, $id, $content, $width = '100%', $height = '320px')
{

// create new CKeditor instance
    include_once ( WB_PATH.'/modules/ckeditor/ckeditor/ckeditor.php' );

    $ckeditor = new CKEditor($name);

    $ckeditor->basePath = WB_URL.'/modules/ckeditor/ckeditor/';

// not working till yet
    $ckeditor->config['height'] = $height;
    $ckeditor->config['width'] = $width;

 // obtain template name of current page for editor.css (if empty, no editor.css files exists)
    $css_template_name = get_css_template_name();
    $ckeditor->config['contentsCss'] = ( $css_template_name == 'none' )
? WB_URL.'/modules/ckeditor/wb_config/editor.css'
: $css_template_name;

    // obtain template name of current page for editor.styles.js (if empty, no editor.styles.js files exists)
    $styles_template_name = get_styles_template_name();

    // editor.styles.js file exists in default template folder, or template folder of current page
    $styles_url = ( $styles_template_name == "none" )
? WB_URL.'/modules/ckeditor/wb_config/editor.styles.js'
: $styles_template_name;

    // The Styles dropdown in the editor. The styles_set needs to be set in each editor.styles.js!
    $ckeditor->config['stylesSet'] = 'wb:'.$styles_url;
    // The Templates list ("presets" like two columns with a picture) in the editor.
    // The templates definition set to use. It accepts a comma separated list.
    $ckeditor->config['templates'] = 'default';
    // The list of templates definition files to load.
    $ck_templates_files[] = WB_URL.'/modules/ckeditor/wb_config/editor.templates.js';
    $ckeditor->config['templates_files'] = $ck_templates_files;
    
    // The filebrowser are called in the include, because later on we can make switches, use WB_URL and so on
    $connectorPath = $ckeditor->basePath.'filemanager/connectors/php/connector.php';
    $ckeditor->config['filebrowserBrowseUrl'] = $ckeditor->basePath.'filemanager/browser/default/browser.html?Connector='.$connectorPath;
    $ckeditor->config['filebrowserImageBrowseUrl'] = $ckeditor->basePath.'filemanager/browser/default/browser.html?Type=Image&Connector='.$connectorPath;
    $ckeditor->config['filebrowserFlashBrowseUrl'] = $ckeditor->basePath.'filemanager/browser/default/browser.html?Type=Flash&Connector='.$connectorPath;
    // The Uploader has to be called, too.
    $uploadPath = $ckeditor->basePath.'filemanager/connectors/php/upload.php?Type=';
    $ckeditor->config['filebrowserUploadUrl'] = $uploadPath.'File';
    $ckeditor->config['filebrowserImageUploadUrl'] = $uploadPath.'Image';
    $ckeditor->config['filebrowserFlashUploadUrl'] = $uploadPath.'Flash';
    
    $ckeditor->editor($name, reverse_htmlentities($content));

}

?>