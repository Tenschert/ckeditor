<?php

// $Id: fck_wbmodules.php 1161 2009-10-11 16:45:19Z Luisehahne $

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