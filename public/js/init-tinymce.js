tinymce.init({
    selector: "textarea",
    theme: "modern",
    plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "save table contextmenu directionality emoticons template paste textcolor responsivefilemanager"
    ],
    content_css: "css/content.css",
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent responsivefilemanager | link image | print preview code | caption media fullpage | forecolor backcolor emoticons imageupload",
    image_caption: true,
    image_advtab: true,
    // paste_data_images: true,
    external_filemanager_path: tinyurl + "/filemanager/",
    filemanager_title: "File Manager",
    external_plugins: {"filemanager" : "filemanager/plugin.min.js"},
    // visualblocks_default_state: true,
    style_formats_autohide: true,
    style_formats_merge: true,
    relative_urls: false
});