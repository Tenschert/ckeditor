<?php

/**
 * @category        modules
 * @package         wysiwyg
 * @author          WebsiteBaker Project, Michael Tenschert
 * @copyright       2010, Michael Tenschert
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/lgpl.html
 */

global $database;

$debug = true;

if (true === $debug) {
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
}

// Include the config file
require('../../../../../../config.php');

// Create new admin object
require(WB_PATH.'/framework/class.admin.php');
$admin = new admin('Pages', 'pages_modify', false);

$list = "[";
$page_titles = "var wblink_titles = new Array(); ";

// Function to generate page list
function gen_page_list($parent) {
	global $database, $admin, $list, $page_titles;
	
	$get_pages = $database->query("SELECT * FROM `".TABLE_PREFIX."pages` WHERE `parent`= '".$parent."' order by `position`");
	
	while( !false == ($page = $get_pages->fetchRow() ) ) {
		
		if(method_exists($admin, 'page_is_visible') && !$admin->page_is_visible($page))
			continue;
			
		$title = str_replace(
			array("\"", "'"),
			array("&quote;", "\\\'"),
			$page['menu_title']
		);
		
		// Add leading -'s so we can tell what level a page is at
		$leading_dashes = '';
		for($i = 0; $i < $page['level']; $i++) $leading_dashes .= '- ';
		
		$list .= "[ \"".$leading_dashes." ".$title."\",'[wblink".$page['page_id']."]'],";
		$page_titles .= " wblink_titles['[wblink".$page['page_id']."]']='".$title."';";
		
		gen_page_list($page['page_id']);
	}
}

$get_pages = $database->query("SELECT * FROM `".TABLE_PREFIX."pages` WHERE `parent`= '0' order by `position`");

if($get_pages->numRows() > 0) {
	// Loop through pages
	while(!false == ($page = $get_pages->fetchRow() ) ) {
		
		if(method_exists($admin, 'page_is_visible') && !$admin->page_is_visible($page))
			continue;
		
		$title = str_replace(
			array("\"", "'"),
			array("&quote;", "\\\'"),
			$page['menu_title']
		);
		
		$list .= "[ '".$title."','[wblink".$page['page_id']."]'],";
		$page_titles .= " wblink_titles['[wblink".$page['page_id']."]']='".$title."';";
		
		gen_page_list($page['page_id']);
	}
	$list = substr($list, 0, -1);
	
} else {
	/**
	 *	None found
	 *
	 */
	 $list .= "['non found', 'none']";
}

$list .= "]";
$page_titles .= "";

?>
CKEDITOR.dialog.add( 'wblinkDlg', function( editor ) {
    return { 
        title: 'WB Link - Insert WebsiteBaker Link',
        minWidth: 280,
        minHeight: 80,
        contents: [ 
            {
                id: 'tab1',
                label: 'Tab1',
                title: 'Tab1',
                elements : [{
                        id: 'wblinks',
                        type: 'select',
                        label: "WB Page",
                        labelLayout:'horizontal',
						widths:['20%','80%'],
						style: 'width: 150px; margin-left: 10px; margin-top:-3px;',
                        validate : function() {},
                        items: <?php echo $list; ?>
                    }, {
                    	id: 'wblinkclass',
                    	type: 'text',
                    	label: 'Class',
                    	labelLayout:'horizontal',
						widths:['50%','50%'],
						style: 'width: 150px; margin-left: 10px, padding-left: 30px;',
						validate: function() {}
                    }, {
                    	id: 'wblinkusepagename',
                    	type: 'checkbox',
                    	label: 'use Pagetitle',
						labelLayout:'horizontal',
						widths:['50%','50%'],
						value: 1,
                    	validate: function() {}
                    
                    }, { 
                    	id: 'wblinkhiddenhtml',
                    	type: 'html',
                    	style: 'display: hidden',
                    	html: "<script><?php echo $page_titles; ?></script>"
                    } ] 
            }
            ],
         onOk: function() {
         	
         	/**
         	 *	Getting the value of our page-select
         	 *
         	 */
         	var ref = this.getContentElement("tab1", "wblinks").getInputElement();
         	var wb_link = ref.getValue();
         	
         	var class_name = this.getContentElement("tab1", "wblinkclass").getInputElement().getValue();
			if (class_name.length > 0 ) class_name = " class='"+class_name+"' ";
				
			/**
			 *	Should we use the selected page-title instead of "[[wblinkxxx]]"?
			 *
			 */
			var link_text = wb_link;
			var use_title = false;
			
			var ref_c = this.getContentElement("tab1", "wblinkusepagename").getInputElement();
			if (ref_c) {
				if (ref_c.$.checked == true) {
					/**
					 *	In the hidden ui-element "wblinkhiddenhtml"
					 *	the array "wblink_titles" is defined.
					 *
					 */
					if (wblink_titles) link_text = wblink_titles[wb_link];
					use_title = true;
				}
			}

         	if (wb_link != "none") {
				editor = this.getParentEditor();
				
				var selection = editor.getSelection();
				var	ranges = selection.getRanges();
				
				if ( ranges.length == 1 && ranges[0].collapsed ) {
					
					/**	***********************************************
					 *	Nothing selected ... so we simple append a link
					 *
					 */
					wb_link = "<a href='"+wb_link+"' "+ class_name + ">"+link_text+"</a>";

				} else {
					
					if (use_title == false) {
						var c_ref = ranges[0].cloneContents(); // **!!
						var text = c_ref.$.textContent;
						
						if (text == "") {
							/**
							 *	Image?
							 */
							var s = c_ref.$.firstChild['src'];
							if (s) {

								text = "<img src='" + s + "' ";
								
								var atts = new Array('style', 'class', 'id', 'alt', 'width', 'height', 'border', 'title', 'longdesc', 'usemap');
								var temp = "";
								
								for(var i=0; i< atts.length; i++) {
									temp = c_ref.$.firstChild.getAttribute( atts[i] );
									if (temp) text += " "+atts[i]+"='"+temp+"'";
								}
								
								text += " />";
							}
						}
						
						
						wb_link = "<a href='"+wb_link+"' "+ class_name + ">"+text+"</a>";
										
						selection.selectRanges( ranges );
						
					} else {
					
						wb_link = "<a href='"+wb_link+"' "+ class_name + ">"+link_text+"</a>";
					}
				}
				
				setTimeout( function() {
						editor.fire( 'paste', { 'html': wb_link } );
					}, 
					0
				);
			}
			
			return true;
         },
         resizable: 3
    };
} );