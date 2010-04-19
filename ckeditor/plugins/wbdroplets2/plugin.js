/**
 * @category        modules
 * @package         wysiwyg
 * @author          WebsiteBaker Project, Michael Tenschert
 * @copyright       2010, Michael Tenschert
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/lgpl.html
 */

// Register the related commands.
CKEDITOR.plugins.add('WBDroplets2',
{
    requires: ['iframedialog'],
    init: function(editor)
    {
        var pluginName = 'WBDroplets2';
        editor.addCommand('WBDroplets2Dlg', new CKEDITOR.dialogCommand('WBDroplets2Dlg'));
        editor.ui.addButton('WBDroplets2',
            {
                label: 'WB Droplets2 Old!',
                command: 'WBDroplets2Dlg',
                icon: this.path + 'images/wbdroplets.gif'
            });
        CKEDITOR.dialog.add('WBDroplets2Dlg', this.path + 'dialogs/wbdroplets.js');
    }
});