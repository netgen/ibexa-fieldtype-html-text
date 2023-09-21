import tinymce from '../public/tinymce/tinymce.min'
import '../public/tinymce/themes/silver/theme.min';
import '../public/tinymce/plugins/link/plugin';
import '../public/tinymce/plugins/lists/plugin.min';

export default function nghtmltextTinyMCE(selector) {
    tinymce.init({
        selector: selector,
        base_url: '/bundles/netgenibexafieldtypehtmltext/tinymce/',
        statusbar: false,
        menubar: false,
        toolbar: 'undo redo | blocks | ' +
            'bold italic underline strikethrough | blockquote | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist | outdent indent | ' +
            'link unlink | removeformat',
        plugins: 'link lists'
    });
}
