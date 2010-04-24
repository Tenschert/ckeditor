<?php

/**
 * @category        modules
 * @package         wysiwyg - ck editor - wbdroplets
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

global $database;
$get_droplet = $database->query("SELECT * FROM `".TABLE_PREFIX."mod_droplets` where `active`=1 ORDER BY `name`");

$list = "[";
$desc_list = "var info = new Array();";

if($get_droplet->numRows() > 0) {
	
	/**
	 *	Loop through ...
	 *
	 */
	while($droplet = $get_droplet->fetchRow()) {
		
		$title	= stripslashes($droplet['name']);
		$desc	= stripslashes($droplet['description']);
		$comm	= stripslashes($droplet['comments']);
		
		$list .= "\n['".$title."', '[[".$title."]]'],";
		$desc_list .= "info['[[".$title."]]']='".trim($desc)."<br /><br />".trim($comm)."';"; 
		
	}
	$list = substr( $list, 0, -1 );
}
$list .= "]";
$desc_list .= "\n";

?>
CKEDITOR.dialog.add( 'wbdropletsDlg', function( editor ) {
    return { 
        title: editor.lang.wbdroplets.name,
        minWidth: 280,
        minHeight: 80,
        contents: [ 
            {
                id: 'tab1',
                label: 'Tab1',		
                title: 'Tab1',
                elements : [{
                        id: 'wbdroplets',
                        type: 'select',
                        label: "Droplets",
						labelLayout:'horizontal',
						widths:['20%','80%'],
						style: 'width: 150px; margin-left: 10px; margin-top:-3px;',
                        validate : function() { },
						items: <?php echo $list; ?>,
						onMouseUp: function() { 
							/** 
							 *	code to display the description of the droplets ... 
							 *
							 */
							<?php echo $desc_list; ?>;
							var droplet_name = this.getValue();
							var ref = document.getElementById("droplet_info");
							ref.innerHTML = info[droplet_name];
						},
						onShow: function() { 
							this.onMouseUp();
						}
                    } , {
                    	id: 'droplet_info_box',
                    	type: 'html',
                    	label: 'Info',
                    	labelLayout:'horizontal',
                    	widths:['20%','80%'],
                    	style:	"display: inline; " +
                    			"float: left; " +
                    			"margin-left: 0; " +
                    			"padding-left: 10px; " +
                    			"width: 250px !important; " +
                    			"height: 100px;" +
                    			"white-space: normal !important;",
                    	html: "<div id='droplet_info'>Hello</div>"
                    } ] 
            }
            ],
         onOk: function() {
         	
         	/**
         	 *	Getting the value of our droplet-select
         	 *
         	 */
         	var droplet_name = this.getContentElement("tab1", "wbdroplets").getInputElement().getValue();
         	
         	editor = this.getParentEditor();
         	editor.fire('paste', { 'text' : droplet_name } );
         	
			return true;
         },
       
         resizable: 2
    };
} );