<?php

/**
 * @category        modules
 * @package         wysiwyg
 * @author          WebsiteBaker Project, Michael Tenschert
 * @copyright       2010, Michael Tenschert
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/lgpl.html
 */

// prevent this file from being accessed directly
if (!defined('WB_PATH')) die (header('Location: index.php'));

// Prevent mixing-up when moving from SourceCode to WYSIWYG and back
function reverse_htmlentities($mixed)
    {
    $mixed=str_replace(array('&gt;','&lt;','&quot;','&amp;'),
                       array('>','<','"','&'),$mixed);
    return $mixed;
    }

// For the editor.css we need to know if it exists and where it is
function get_css_template_name()
    {
    // returns the template name of the current displayed page
    require_once (WB_PATH . '/framework/class.database.php');

    // work out default editor.css file for CKEditor
    if (file_exists(WB_PATH . '/templates/' . DEFAULT_TEMPLATE . '/editor.css'))
        {
        $ck_css_template_dir = DEFAULT_TEMPLATE;
        }
    elseif (file_exists(WB_PATH . '/templates/' . DEFAULT_TEMPLATE . '/css/editor.css'))
        {
        $ck_css_template_dir = DEFAULT_TEMPLATE . '/css';
        }
    else
        {
        $ck_css_template_dir = "none";
        }

    // check if an editor.css file exists in the specified template directory of current page
    if (isset($_GET["page_id"]) && (int)$_GET["page_id"] > 0)
        {
        $pageid=(int)$_GET["page_id"];

        // obtain template folder of current page from the database
        if (!isset($admin))
            {
            $database=new database();
            }

        $query_page="SELECT template FROM " . TABLE_PREFIX . "pages WHERE page_id =$pageid";
        $pagetpl   =$database->get_one($query_page); // if empty, default template is used

        // check if a specific template is defined for current page
        if (isset($pagetpl) && $pagetpl != '')
            {
            // check if a specify editor.css file is contained in that folder
            if (file_exists(WB_PATH . '/templates/' . $pagetpl . '/editor.css'))
                {
                $ck_css_template_dir=$pagetpl;
                }
            elseif (file_exists(WB_PATH . '/templates/' . $pagetpl . '/css/editor.css'))
                {
                $ck_css_template_dir = $pagetpl . '/css';
                }
            else
                {
                $ck_css_template_dir = "none";
                }
            }
        }
    return $ck_css_template_dir;
    }
    
// For the editor.styles.js we need to know if it exists and where it is
function get_styles_template_name()
    {
    // returns the template name of the current displayed page
    require_once (WB_PATH . '/framework/class.database.php');

    // work out default editor.styles.js file for CKEditor
    if (file_exists(WB_PATH . '/templates/' . DEFAULT_TEMPLATE . '/editor.styles.js'))
        {
        $ck_styles_template_dir = DEFAULT_TEMPLATE;
        }
    elseif (file_exists(WB_PATH . '/templates/' . DEFAULT_TEMPLATE . '/js/editor.styles.js'))
        {
        $ck_styles_template_dir = DEFAULT_TEMPLATE . '/js';
        }
    else
        {
        $ck_styles_template_dir = "none";
        }

    // check if an editor.css file exists in the specified template directory of current page
    if (isset($_GET["page_id"]) && (int)$_GET["page_id"] > 0)
        {
        $pageid=(int)$_GET["page_id"];

        // obtain template folder of current page from the database
        if (!isset($admin))
            {
            $database=new database();
            }

        $query_page="SELECT template FROM " . TABLE_PREFIX . "pages WHERE page_id =$pageid";
        $pagetpl   =$database->get_one($query_page); // if empty, default template is used

        // check if a specific template is defined for current page
        if (isset($pagetpl) && $pagetpl != '')
            {
            // check if a specify editor.styles.js file is contained in that folder
            if (file_exists(WB_PATH . '/templates/' . $pagetpl . '/editor.styles.js'))
                {
                $ck_styles_template_dir = $pagetpl;
                }
            elseif (file_exists(WB_PATH . '/templates/' . $pagetpl . '/css/editor.styles.js'))
                {
                $ck_styles_template_dir = $pagetpl . '/js';
                }
            else
                {
                $ck_styles_template_dir = "none";
                }
            }
        }
    return $ck_styles_template_dir;
    }
    
function show_wysiwyg_editor($name, $id, $content, $width, $height)
    {
    // create new CKeditor instance
    include_once (WB_PATH . '/modules/ckeditor/ckeditor/ckeditor.php');
    $ckeditor          =new CKEditor($name);
    $ckeditor->basePath=WB_URL . '/modules/ckeditor/ckeditor/';

    // obtain template name of current page for editor.css (if empty, no editor.css files exists)
    $css_template_name = get_css_template_name();

    if ($css_template_name == "none")
        {
        // no editor.css file exists in default template folder, or template folder of current page
        $css_file = WB_URL . '/modules/ckeditor/wb_config/editor.css';
        }
    else
        {
        // editor.css file exists in default template folder or template folder of current page
        $css_file = WB_URL . '/templates/' . $css_template_name . '/editor.css';
        }
    // obtain template name of current page for editor.styles.js (if empty, no editor.styles.js files exists)
    $styles_template_name = get_styles_template_name();
    
    $ckeditor->config['contentsCss'] = $css_file;

    if ($styles_template_name == "none")
        {
        // no editor.styles.js file exists in default template folder, or template folder of current page
        $styles_url = WB_URL . '/modules/ckeditor/wb_config/editor.styles.js';
        }
    else
        {
        // editor.styles.js file exists in default template folder or template folder of current page
        $styles_url = WB_URL . '/templates/' . $styles_template_name . '/editor.styles.js';
        }
    
    // The Styles dropdown in the editor. The styles_set needs to be set in each editor.styles.js!
    $styles_set                           = 'wb';
    $styles_file                          = $styles_set . ':' . $styles_url;
    $ckeditor->config['stylesSet']        = $styles_file;
    
    // The Templates list ("presets" like two columns with a picture) in the editor.
    // The templates definition set to use. It accepts a comma separated list.
    $ckeditor->config['templates']        = 'default';
    // The list of templates definition files to load. 
    $ck_templates_files[] = WB_URL.'/modules/ckeditor/wb_config/editor.templates.js';
    $ckeditor->config['templates_files']  = $ck_templates_files;
    
    $ckeditor->editor($name, reverse_htmlentities($content));
}
?>