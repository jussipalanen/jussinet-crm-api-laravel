{{-- <script src="https://cdn.tiny.cloud/1/{{ env('TINYMCE_API_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin">
</script> --}}
<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
@if ($options)
    @foreach ($options as $option)
        @php
            $plugins = isset($options['plugins']) ? $options['plugins'] : "['advlist autolink lists link image charmap print preview anchor', 'searchreplace visualblocks code fullscreen', 'insertdatetime media table paste code help wordcount', 'image']";
            $toolbar = isset($options['toolbar']) ? $options['toolbar'] : 'undo redo | formatselect | ' .
                    'bold italic backcolor | alignleft aligncenter ' .
                    'alignright alignjustify | bullist numlist outdent indent | ' .
                    'removeformat | help';
        @endphp
        <script type="text/javascript">
            tinymce.init({
                selector: "{{ $option['selector'] }}",
                height: 300,
                menubar: false,
                plugins: "{{$plugins}}",
                toolbar: "{{$toolbar}}",
                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        </script>
    @endforeach

@endif
