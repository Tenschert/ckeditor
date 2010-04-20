<?php

/**
 * @category        modules
 * @package         wysiwyg
 * @author          WebsiteBaker Project, Michael Tenschert
 * @copyright       2010, Michael Tenschert
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/lgpl.html
 */

// Must include code to stop this file being access directly
if(defined('WB_PATH') == false) { exit("Cannot access this file directly"); }

// Delete the editor directory
rm_full_dir(WB_PATH.'/modules/ckeditor/ckeditor');
?>