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
$template = new Template(WB_PATH.'/modules/ckeditor/ckeditor/plugins/wbdroplets/dialogs');
$template->set_file('page', 'wbdroplets.htt');
$template->set_block('page', 'main_block', 'main');

// Get pages and put them into the pages list
$template->set_block('main_block', 'droplets_list_block', 'page_list');
$database = new database();
$get_droplet = $database->query("SELECT * FROM ".TABLE_PREFIX."mod_droplets where active=1 ORDER BY name");
if($get_droplet->numRows() > 0) {
	// Loop through pages
	$list = "";
	while($droplet = $get_droplet->fetchRow()) {
		// method page_is_visible was introduced with WB 2.7
		$title = stripslashes($droplet['name']);
		$desc = stripslashes($droplet['description']);
		$comm = stripslashes($droplet['comments']);
		$template->set_var('TITLE', $title);
		$template->set_var('DESC', $desc);
		$list .= "<div id='".$title."' class='hidden'><b>".$title.": </b> ".$desc."<br>".$comm."</div>";
		$template->parse('page_list', 'droplets_list_block', true);
	}
} else {
	$template->set_var('TITLE', 'None found');
	$template->parse('page_list', 'droplets_list_block', false);
}
$template->set_var('LIST', $list);
$template->set_var("CHARSET", defined('DEFAULT_CHARSET') ? DEFAULT_CHARSET : 'utf-8' );

// Parse the template object
$template->parse('main', 'main_block', false);
$template->pparse('output', 'page');

?>
