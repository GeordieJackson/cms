{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>--}}
<script src="https://cdn.tiny.cloud/1/03td8j5wbpgdt9bauwyzo91xq65zr6r3t8m1ueev30yycw15/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>


<script>
    // Basic input
    tinymce.init({
        selector: '.js-postform textarea',
        body_class: 'prose',
        // height: 500,
        //   menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount importcss'
        ],
        toolbar: 'undo redo | formatselect | ' +
            'bold italic |  bullist numlist blockquote | image media | ' +
            'removeformat | help',
        menu: {
            favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | spellchecker | emoticons'}
        },
        menubar: 'favs file edit view insert format tools table help',
        content_css: '{{route('home')}}/css/tinymce.css',
        importcss_file_filter: '{{route('home')}}/css/tinymce.css',
    });
</script>


{{--<script>tinymce.init({--}}
{{--        selector: '.js-postform textarea',--}}
{{--        plugins: [--}}
{{--            'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',--}}
{{--            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media importcss nonbreaking',--}}
{{--            'table emoticons template paste help'--}}
{{--        ],--}}
{{--        toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +--}}
{{--            'bullist numlist outdent indent | link image | print preview media fullpage | ' +--}}
{{--            'forecolor backcolor emoticons | help',--}}
{{--        menu: {--}}
{{--            favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | spellchecker | emoticons'}--}}
{{--        },--}}
{{--        menubar: 'favs file edit view insert format tools table help',--}}
{{--        content_css: '{{route('home')}}/css/tinymce.css',--}}
{{--        importcss_file_filter: '{{route('home')}}/css/tinymce.css',--}}
{{--        // importcss_append: true--}}
{{--    });--}}
{{--</script>--}}
