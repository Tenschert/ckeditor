/**
 * @category        modules
 * @package         wysiwyg
 * @author          WebsiteBaker Project, Michael Tenschert
 * @copyright       2010, Michael Tenschert
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/lgpl.html
 */

// Register the related commands.
CKEDITOR.plugins.add('WBDroplets',
{
    init: function(editor)
    {
        var pluginName = 'WBDroplets';
        editor.addCommand('WBDropletsDlg', new CKEDITOR.dialogCommand('WBDropletsDlg'));
        editor.ui.addButton('WBDroplets',
            {
                label: 'WB Droplets',
                command: 'WBDropletsDlg',
                icon: this.path + 'images/wbdroplets.gif'
            });
        CKEDITOR.dialog.add('WBDropletsDlg', this.path + 'dialogs/wbdroplets.js');
    }
});