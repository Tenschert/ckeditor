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

// Function to generate page list
function gen_page_list($parent) {
	global $database, $admin, $list;
	
	$get_pages = $database->query("SELECT * FROM ".TABLE_PREFIX."pages WHERE parent = '$parent' order by position");
	
	while($page = $get_pages->fetchRow()) {
		// method page_is_visible was introduced with WB 2.7
		if(method_exists($admin, 'page_is_visible') && !$admin->page_is_visible($page))
			continue;
			
		$title = str_replace("\"", "&quote;", $page['menu_title']);
		// Add leading -'s so we can tell what level a page is at
		$leading_dashes = '';
		for($i = 0; $i < $page['level']; $i++) {
			$leading_dashes .= '- ';
		}
	
		$list .= "[ \"".$leading_dashes." ".$title."\",'[wblink".$page['page_id']."]'],";
		
		gen_page_list($page['page_id']);
	}
}

$get_pages = $database->query("SELECT * FROM ".TABLE_PREFIX."pages WHERE parent = '0' order by position");

if($get_pages->numRows() > 0) {
	// Loop through pages
	while($page = $get_pages->fetchRow()) {
		
		if(method_exists($admin, 'page_is_visible') && !$admin->page_is_visible($page))
			continue;
		
		$title = stripslashes($page['menu_title']);
		$list .= "[ '".$title."','[wblink".$page['page_id']."]'],";
		
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
                    } /*, {
                    	id: 'wblinkusepagename',
                    	type: 'checkbox',
                    	label: 'use Pagetitle',
						labelLayout:'horizontal',
						widths:['50%','50%'],
                    	validate: function() {}
                    
                    }*/] 
            }
            ],
         onOk: function() {
         	
         	/**
         	 *	Getting the value of our page-select
         	 *
         	 */
         	var ref = this.getContentElement("tab1", "wblinks").getInputElement();
         	var wb_link = ref.getValue();
         	var wb_link_index = ref.getIndex();
			
			var class_name = this.getContentElement("tab1", "wblinkclass").getInputElement().getValue();
			if (class_name.length > 0 ) class_name = " class='"+class_name+"' ";
					
         	if (wb_link != "none") {
				editor = this.getParentEditor();
				
				var selection = editor.getSelection();
				var	ranges = selection.getRanges();
				
				if ( ranges.length == 1 && ranges[0].collapsed ) {
					
					/**
					 *	Nothing selected ... so we simple append a link
					 *
					 */
					wb_link = "<a href='"+wb_link+"' "+ class_name + ">"+wb_link+"</a>";

				} else {
					
					var c_ref = ranges[0].cloneContents(); // **!!
					var text = c_ref.$.textContent;
					
					wb_link = "<a href='"+wb_link+"' "+ class_name + ">"+text+"</a>";
										
					selection.selectRanges( ranges );
					
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