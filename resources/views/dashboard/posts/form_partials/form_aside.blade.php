@section('meta')
    <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/material_blue.css">
@endsection
<div class="post_container-aside">

    <div class="post_container-aside-row">
        <div class="post_container-aside-row-label">
            <label for="owner">Author:</label>
        </div>
        <div class="post_container-aside-row-input">
            <select name="owner_id" id="owner_id">
                @foreach($authors as $author)
                    <option value="{{$author->id}}"
                            @if(isset($create))
                            @if($author->id == auth()->id()) selected="1" @endif
                            @else
                            @if($author->id == $post->owner->id || $author->id == old('owner_id')) selected="1" @endif
                            @endif
                    >{{$author->name}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Published form input -->
    <div class="post_container-aside-row">
        <div class="post_container-aside-row-label">
            <label for="published">Published:</label>
        </div>
        <div class="post_container-aside-row-input">
            <div>
                <input type="checkbox" name="published" id="published"
                       @if(old('published') || $post->published)checked="1" @endif>
            </div>
        </div>
    </div>

    <!-- Publication_date form input -->
    <div class="post_container-aside-row">
        <div class="post_container-aside-row-label">
            <label for="publication_date">Publish date:</label>
        </div>
        <div class="post_container-aside-row-input">
            <input type="text" class="js-datepicker" name="publication_date" id="publication_date"
                   value="{{old('publication_date') ?? $post->publication_date }}">
        </div>
    </div>

    <!-- Pdf form input -->
    <div class="post_container-aside-row">
        <div class="post_container-aside-row-label">
            <label for="pdf">PDF:</label>
        </div>
        <div class="post_container-aside-row-input">
            <input type="text" id="pdf" name="pdf" value="{{ old('pdf') ?? $post->pdf }}">
        </div>
    </div>

    <!-- Sticky form input -->
    <div class="post_container-aside-row hidden" id="sticky_row">
        <div class="post_container-aside-row-label">´
            <label for="sticky">Sticky:</label>
        </div>
        <div class="post_container-aside-row-input">
            <div>
                <input type="checkbox" id="sticky" name="sticky" @if(old('sticky') || $post->sticky)checked="1" @endif>
            </div>
        </div>
    </div>

    <!-- Tags form input -->
    <div class="post_container-aside-row hidden" id="tags_row">
        <div class="post_container-aside-row-label">
            <label for="tags">Tags:</label>
        </div>
        <div class="post_container-aside-row-input">
            <input type="text" id="tags" name="tags" value="{{old('tags') ?? $tags}}">
        </div>
    </div>

    <livewire:files-uploader :post="$post"></livewire:files-uploader>

{{--    <div class="post_container-aside-row hidden" id="image_row">--}}
{{--        <div class="post_container-image_preview" id="image_preview">--}}
{{--            <img id="img" src="" alt="">--}}
{{--        </div>--}}
{{--    </div>--}}

    @section('js')
        @parent
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            $(".js-datepicker").flatpickr({
                enableTime: true,
                altInput: true,
                altFormat: "j F, Y H:i",
                dateFormat: "Y-m-d H:i",
                weekNumbers: true,
            });
        </script>
@endsection

