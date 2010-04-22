/**
 * @category        modules
 * @package         wysiwyg
 * @author          WebsiteBaker Project, Michael Tenschert
 * @copyright       2010, Michael Tenschert
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/lgpl.html
 */

// Register the related commands.
CKEDITOR.plugins.add('wblink',
{
    lang : ['en','de','nl','ru'],
    requires: ['iframedialog'],
    init: function(editor)
    {
        var pluginName = 'wblink';
        editor.addCommand('WBLinkDlg', new CKEDITOR.dialogCommand('WBLinkDlg'));
        editor.ui.addButton('WBLink',
            {
                label: editor.lang.wblink.btn,
                command: 'WBLinkDlg',
                icon: this.path + 'images/wblink.gif'
            });
        CKEDITOR.dialog.add('WBLinkDlg', this.path + 'dialogs/wblink.php');
    }
});