CKEDITOR.replace('ckeditor');
CKEDITOR.editorConfig = function (config) {

    config.toolbar = [
        {name: 'document', items: ['Preview', 'Print', 'Templates']},
        {name: 'clipboard', items: ['Undo', 'Redo']},
        {name: 'editing', items: ['Find', 'Replace', 'SelectAll']},
        {name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'RemoveFormat']},
        {name: 'paragraph', items: ['NumberedList', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
        {name: 'insert', items: ['Image', 'Table', 'Link']},
        
        { name: 'colors', items : [ 'TextColor','BGColor' ] },
        {name: 'styles', items: ['Styles', 'Format', 'Font', 'FontSize' ]},
    ];

};
CKEDITOR.config.height = 400;