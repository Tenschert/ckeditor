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
    init: function(editor)
    {
        var pluginName = 'wblink';
        editor.addCommand('wblinkDlg', new CKEDITOR.dialogCommand('wblinkDlg'));
        editor.ui.addButton('wblink',
            {
                label: editor.lang.wblink.btn,
                command: 'wblinkDlg',
                icon: this.path + 'images/wblink.gif'
            });
        CKEDITOR.dialog.add('wblinkDlg', this.path + 'dialogs/wblink.php');
    }
});