
import './basePath.js';

const CKeditor = require('../public/build/ckeditor/ckeditor.js');

var ready = (callback) => {
    if (document.readyState != "loading") callback();
    else document.addEventListener("DOMContentLoaded", callback);
}

ready(() => {
    var ckEditorTextareas = document.querySelectorAll('.nghtmltext > textarea');

    ckEditorTextareas.forEach((ckEditor) => {
        CKEDITOR.inline(ckEditor.id, {
            extraPlugins: 'justify',
            removePlugins:
                'colorbutton,find,flash,font,' +
                'forms,iframe,image,newpage,removeformat,' +
                'smiley,specialchar,stylescombo,templates',

            // Rearrange the toolbar layout.
            toolbarGroups: [
                { name: 'undo' },
                { name: 'styles' },
                { name: 'insert' },
                { name: 'editing', groups: [ 'basicstyles', 'links' ] },
                { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            ],

            startupFocus: true,
        });
    });
});
