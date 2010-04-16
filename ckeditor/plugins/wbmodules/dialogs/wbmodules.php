<?php

/**
 * @category        modules
 * @package         wysiwyg
 * @author          WebsiteBaker Project, Michael Tenschert
 * @copyright       2010, Michael Tenschert
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/lgpl.html
 */

// Include the config file
require('../../../../../../config.php');

// Create new admin object
require(WB_PATH.'/framework/class.admin.php');
$admin = new admin('Pages', 'pages_modify', false);

// Setup the template
$template = new Template(WB_PATH.'/modules/fckeditor/fckeditor/editor/plugins/WBModules');
$template->set_file('page', 'wbmodules.htt');
$template->set_block('page', 'main_block', 'main');

// Function to generate page list
function gen_page_list($parent) {
	global $template, $database, $admin;
	$get_pages = $database->query("SELECT * FROM ".TABLE_PREFIX."pages WHERE parent = '$parent' order by position");
	while($page = $get_pages->fetchRow()) {
		// method page_is_visible was introduced with WB 2.7
		if(method_exists($admin, 'page_is_visible') && !$admin->page_is_visible($page))
			continue;
		$title = stripslashes($page['menu_title']);
		// Add leading -'s so we can tell what level a page is at
		$leading_dashes = '';
		for($i = 0; $i < $page['level']; $i++) {
			$leading_dashes .= '- ';
		}
		$template->set_var('TITLE', $leading_dashes.' '.$title);
		$template->set_var('LINK', '[wblink'.$page['page_id'].']');
		/**
			Note: FCK uses the header defined in /fckeditor/fckeditor/editor/fckdialog.html
			Therefore the WB charset defined in the template: wbmodules.html will be overwritten
			Routine kept for now, maybe it is possible to define custom plugin charsets in a future FCK releases (doc)
		*/
		// work out the specified WB charset 
		if(defined('DEFAULT_CHARSET')) { 
			$template->set_var('CHARSET', DEFAULT_CHARSET);
		} else { 
			$template->set_var('CHARSET', 'utf-8');
		}
		$template->parse('page_list', 'page_list_block', true);
		gen_page_list($page['page_id']);
	}
}

// Get pages and put them into the pages list
$template->set_block('main_block', 'page_list_block', 'page_list');
$database = new database();
$get_pages = $database->query("SELECT * FROM ".TABLE_PREFIX."pages WHERE parent = '0' order by position");
if($get_pages->numRows() > 0) {
	// Loop through pages
	while($page = $get_pages->fetchRow()) {
		// method page_is_visible was introduced with WB 2.7
		if(method_exists($admin, 'page_is_visible') && !$admin->page_is_visible($page))
			continue;
		$title = stripslashes($page['menu_title']);
		$template->set_var('TITLE', $title);
		$template->set_var('LINK', '[wblink'.$page['page_id'].']');
		$template->parse('page_list', 'page_list_block', true);
		gen_page_list($page['page_id']);
	}
} else {
	$template->set_var('TITLE', 'None found');
	$template->set_var('LINK', 'None found');
	$template->parse('page_list', 'page_list_block', false);
}

// Parse the template object
$template->parse('main', 'main_block', false);
$template->pparse('output', 'page');

?>