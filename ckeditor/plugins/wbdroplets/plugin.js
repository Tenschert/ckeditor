/**
 * @category        modules
 * @package         wysiwyg
 * @author          WebsiteBaker Project, Michael Tenschert
 * @copyright       2010, Michael Tenschert
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/lgpl.html
 */

// Register the related commands.
CKEDITOR.plugins.add('wbdroplets',
{
    lang : ['en','de','nl'],
    init: function(editor)
    {
        editor.addCommand('wbdropletsDlg', new CKEDITOR.dialogCommand('wbdropletsDlg'));
        editor.ui.addButton('wbdroplets',
            {
                label: editor.lang.wbdroplets.btn,
                command: 'wbdropletsDlg',
                icon: this.path + 'images/wbdroplets.gif'
            });
        CKEDITOR.dialog.add('wbdropletsDlg', this.path + 'dialogs/wbdroplets.php');
    }
});