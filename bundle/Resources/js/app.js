import Editor from '../public/ckeditor/build/ckeditor';

const ready = (callback) => {
    if (document.readyState !== "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}

ready(async () => {
    const ckEditorTextareas = Array.from(document.querySelectorAll('.nghtmltext > textarea'));

    ckEditorTextareas.forEach((ckEditor) => {
        Editor.create(ckEditor).catch( error => {
            console.error( error );
        } );
    });
});
