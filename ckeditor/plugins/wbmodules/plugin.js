/**
 * @category        modules
 * @package         wysiwyg
 * @author          WebsiteBaker Project, Michael Tenschert
 * @copyright       2010, Michael Tenschert
 * @link            http://www.websitebaker2.org/
 * @license         http://www.gnu.org/licenses/lgpl.html
 */

// Register the related commands.
CKEDITOR.plugins.add('WBModules',
{
    init: function(editor)
    {
        var pluginName = 'WBModules';
        editor.addCommand('WBModulesDlg', new CKEDITOR.dialogCommand('WBModulesDlg'));
        editor.ui.addButton('WBModules',
            {
                label: 'WB Modules',
                command: 'WBModulesDlg',
                icon: this.path + 'images/wbmodules.gif'
            });
        CKEDITOR.dialog.add('WBModulesDlg', this.path + 'dialogs/wbmodules.js');
    }
});