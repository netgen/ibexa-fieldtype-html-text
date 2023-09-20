import tinymce from '../public/tinymce/js/tinymce/tinymce.min'
import '../public/tinymce/js/tinymce/themes/silver/theme.min';
import '../public/tinymce/js/tinymce/plugins/link/plugin';

const ready = (callback) => {
    if (document.readyState !== "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}

ready(() => {

    console.log(document.querySelectorAll('.ibexa-field-edit--nghtmltext textarea'));

    tinymce.init({
        selector: '.ibexa-field-edit--nghtmltext textarea',
        base_url: '/bundles/netgenibexafieldtypehtmltext/tinymce/js/tinymce',
        statusbar: false,
        menubar: false,
        toolbar: 'undo redo | blocks | ' +
            'bold italic underline strikethrough | alignleft aligncenter ' +
            'alignright alignjustify | blockquote | bullist numlist | outdent indent | ' +
            'link unlink',
        plugins: 'link'
    });
});
