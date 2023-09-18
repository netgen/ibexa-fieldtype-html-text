// import moj_ckeditor from '../public/ckeditor/build/ckeditor';

// import CKEditor from '@ckeditor/ckeditor5-editor-inline/src/inlineeditor';

const ready = (callback) => {
    if (document.readyState !== "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}

ready(async () => {
    console.log(CKEditor);
    //
    // console.log("window.ibexa.richText.CKEditor");
    // console.log(typeof window.ibexa.BaseRichText !== 'undefined');
    //
    if (typeof window.ibexa.BaseRichText !== 'undefined') {
        console.log("u ifu");
        CKEditor = require('@ckeditor/ckeditor5-editor-inline/src/inlineeditor');
    }
    const ngHtmlTextEditFields = document.querySelectorAll('.ibexa-field-edit--nghtmltext');

    ngHtmlTextEditFields.forEach((ngHtmlTextEditField) => {

        const ckEditorTextArea = ngHtmlTextEditField.querySelector('textarea');

        // CKEditor.init(ckEditorTextArea);
        console.log(ckEditorTextArea);
        // CKEDITOR.create(ckEditorTextArea).catch( error => {
        //     console.error( error );
        // } );
        // CKEDITOR.create(ckEditor).catch( error => {
        //     console.error( error );
        // } );

        // CKEDITOR.editor(ckEditorTextArea);

    });



    // const ckEditorTextareas = Array.from(document.querySelectorAll('.ibexa-field-edit--nghtmltext > textarea'));

    // ckEditorTextareas.forEach((ckEditor) => {
    //     CKEDITOR.create(ckEditor).catch( error => {
    //         console.error( error );
    //     } );
    // });
});


// import Editor from '../public/ckeditor/build/ckeditor';
//
// const ready = (callback) => {
//     if (document.readyState !== "loading") callback();
//     else document.addEventListener("DOMContentLoaded", callback);
// }
//
// ready(async () => {
//     const ckEditorTextareas = Array.from(document.querySelectorAll('.nghtmltext > textarea'));
//
//     ckEditorTextareas.forEach((ckEditor) => {
//         Editor.create(ckEditor).catch( error => {
//             console.error( error );
//         } );
//     });
// });
