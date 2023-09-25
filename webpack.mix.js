mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css');
mix.copyDirectory('vendor/tinymce/tinymce', 'public/js/tinymce');