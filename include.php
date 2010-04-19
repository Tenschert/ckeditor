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
if (!defined('WB_PATH'))
    die (header('Location: index.php'));

function reverse_htmlentities($mixed)
    {
    $mixed=str_replace(array
        (
        '&gt;',
        '&lt;',
        '&quot;',
        '&amp;'
        ),             array
        (
        '>',
        '<',
        '"',
        '&'
        ),             $mixed);

    return $mixed;
    }

function get_template_name()
    {
    // returns the template name of the current displayed page
    require_once (WB_PATH . '/framework/class.database.php');

    // work out default editor.css file for CKEditor
    if (file_exists(WB_PATH . '/templates/' . DEFAULT_TEMPLATE . '/editor.css'))
        {
        $ck_template_dir=DEFAULT_TEMPLATE;
        }
    elseif (file_exists(WB_PATH . '/templates/' . DEFAULT_TEMPLATE . '/css/editor.css'))
        {
        $ck_template_dir=DEFAULT_TEMPLATE;
        }
    else
        {
        $ck_template_dir=WB_PATH . "/modules/ckeditor/wb_config/contents.css";
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
                $ck_template_dir=$pagetpl;
                }
            elseif (file_exists(WB_PATH . '/templates/' . $pagetpl . '/css/editor.css'))
                {
                $ck_template_dir=$pagetpl;
                }
            }
        }
    else
        {
        $ck_template_dir=WB_PATH . "/modules/ckeditor/wb_config/contents.css";
        }

    return $ck_template_dir;
    }

function show_wysiwyg_editor($name, $id, $content, $width, $height)
    {
    // create new CKeditor instance
    include_once (WB_PATH . '/modules/ckeditor/ckeditor/ckeditor.php');
    $ckeditor          =new CKEditor($name);
    $ckeditor->basePath=WB_URL . '/modules/ckeditor/ckeditor/';
    // obtain template name of current page (if empty, no editor.css files exists)
    $template_name     =get_template_name();

    if ($template_name == "none")
        {
        // no editor.css file exists in default template folder, or template folder of current page
        $css_file=WB_URL . '/modules/ckeditor/wb_config/contents.css';
        }
    else
        {
        // editor.css file exists in default template folder or template folder of current page
        $css_file=WB_URL . '/templates/' . $template_name . '/editor.css';
        }

    // Configure the styles sheets - just now only hardcoded and rudimentary...
    $styles_url                           =WB_URL . '/modules/ckeditor/wb_config/editor.styles.js';
    $styles_set                           ="wb";
    $styles_file                          =$styles_set . ':' . $styles_url;

    $ckeditor->config['contentsCss']      =$css_file;
    $ckeditor->config['stylesSet']        =$styles_file;
    $ckeditor->config['templates']        ="default";
    $ckeditor->config['templates_files'][]=WB_URL . '/modules/ckeditor/wb_config/editor.templates.js';
    $ckeditor->editor($name, reverse_htmlentities($content));
    }
?>