<div class="options_bar">
    {{--    Page type    --}}
    <select name="type" id="type" class="options_bar-item">
        <option value=""> -- Select page type --</option>
        @foreach(pageType() as $name  => $value)
            <option value="{{$value}}"
                    @if( isset($post) && (old('type') == $value || $post->type == $value)) selected="1" @endif
            >{{ucfirst($name)}}
            </option>
        @endforeach
    </select>
    {{--    Temporal names    --}}
    <select name="temporal_id" id="temporal_id"
            class="options_bar-item{{$post->type == pageType()->temporal ? '' : ' hidden'}}">
        <option value=""> -- Select temporal name --</option>
        @foreach($temporal_names as $temporal_name)
            <option value="{{$temporal_name->id}}"
                    @if( old('temporal_id') == $temporal_name->id ) selected="1"
                    @else
                    @if( $post->temporal_id == $temporal_name->id) selected="1"
                    @endif
                    @endif
            >{{ucfirst($temporal_name->name)}}
            </option>
        @endforeach
    </select>
    {{--    Categories    --}}
    <select name="category_id" id="category_id"
            class="options_bar-item{{$post->type == pageType()->categorized ? '' : ' hidden'}}">
        <option value=""> -- Select category --</option>
        @foreach($categories as $category)
            <option value="{{$category->id}}"
                    @if(old('category_id') || $post->category_id)
                    @if( (old('category_id') == $category->id || $category->id == $post->category_id)) selected="1" @endif
                    @endif
            >{{ucwords(str_replace("-"," ",$category->name))}}</option>
        @endforeach
    </select>
    <button class="btn btn-success options_bar-button"
            type="submit">{{ Route::currentRouteName() == 'dashboard.posts.create' ? 'Create' : 'update'}}</button>
</div>


