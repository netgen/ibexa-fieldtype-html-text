import tinymce from '../public/tinymce/js/tinymce/tinymce.min'
import '../public/tinymce/js/tinymce/themes/silver/theme.min';
import '../public/tinymce/js/tinymce/plugins/link/plugin';

const ready = (callback) => {
    if (document.readyState !== "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}

ready(() => {
    tinymce.init({
        selector: '.nghtmltext > textarea',
        base_url: '/bundles/netgenibexafieldtypehtmltext/tinymce/js/tinymce',
        statusbar: false,
        menubar: false,
        toolbar: 'undo redo | blocks | ' +
            'bold italic underline strikethrough | alignleft aligncenter ' +
            'alignright alignjustify | bullist numlist | outdent indent | ' +
            'link unlink | ' +
            'removeformat',
        plugins: 'link'
    });
});
