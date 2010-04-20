<?php

// $Id: fck_wbdroplets.php 1161 2009-10-11 16:45:19Z Luisehahne $

/*

 Website Baker Project <http://www.websitebaker.org/>
 Copyright (C) 2004-2009, Ryan Djurovich

 Website Baker is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 Website Baker is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with Website Baker; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*/

// Include the config file
require('../../../../../../config.php');

// Create new admin object
require(WB_PATH.'/framework/class.admin.php');
$admin = new admin('Pages', 'pages_modify', false);

// Setup the template
$template = new Template(WB_PATH.'/modules/fckeditor/fckeditor/editor/plugins/WBDroplets');
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
		$list .= "<div id='".$title."'><b>".$title.": </b> ".$desc."<br>".$comm."</div>";
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