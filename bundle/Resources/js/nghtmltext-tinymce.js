import tinymce from '../public/tinymce/tinymce.min';

export default function nghtmltextTinyMCE(selector) {
    tinymce.init({
        selector: selector,
        license_key: 'gpl',
        base_url: '/bundles/netgenibexafieldtypehtmltext/tinymce',
        suffix: '.min',
        statusbar: false,
        menubar: false,
        toolbar: 'undo redo | blocks | ' +
            'bold italic underline strikethrough | blockquote | ' +
            'alignleft aligncenter alignright alignjustify | ' +
            'bullist numlist | outdent indent | ' +
            'link unlink | removeformat',
        plugins: 'link lists',
        promotion: false,
        height: '350px',
    });
}
