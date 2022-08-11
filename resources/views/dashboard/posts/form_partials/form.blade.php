<div class="post_container-row">
    <div class="post_container-meta">
        <h3 class="post_container-title">
            <span class="icon-circle-up" id="js-toggle_meta" title="Hide panel"></span>Meta data
        </h3>
    </div>
    <div class="post_container-meta">
        <h3 class="post_container-title"><span class="icon-"></span> Post data</h3>
    </div>
</div>


<div class="post_container-row" id="js-meta_slider">

    <div class="post_container-meta">
        <div class="post_container-body">
            <div class="post_container-data">
                <label class="post_container-data-label" for="meta_title">Title</label>
                <input class="post_container-data-input" type="text" name="meta_title" id="meta_title"
                       value="{{old('meta_title') ?? $post->meta_title}}">
            </div>
            <div class="post_container-data">
                <label class="post_container-data-label" for="meta_description">Description</label>
                <input class="post_container-data-input" type="text" name="meta_description" id="meta_description"
                       value="{{old('meta_description') ?? $post->meta_description}}">
            </div>
            <div class="post_container-data">
                <label class="post_container-data-label" for="meta_keywords">Keywords</label>
                <input class="post_container-data-input" type="text" name="meta_keywords" id="meta_keywords"
                       value="{{old('meta_keywords') ?? $post->meta_keywords}}">
            </div>
        </div>
    </div>

    <div class="post_container-meta">
        <div class="post_container-body">
            <div class="post_container-data">
                <label class="post_container-data-label" for="title">Title</label>
                <input class="post_container-data-input" type="text" name="title" id="title" value="{{old('title') ?? $post->title}}">
            </div>
            <div class="post_container-data">
                <label class="post_container-data-label" for="slug">Slug</label>
                <input class="post_container-data-input" type=slug" name="slug" id="slug" value="{{old('slug') ?? $post->slug}}">
            </div>
            <div class="post_container-data">
                <label class="post_container-data-label" for="subtitle">Subtitle</label>
                <input class="post_container-data-input" type="text" name="subtitle" id="subtitle" value="{{old('subtitle') ?? $post->subtitle}}">
            </div>
        </div>
    </div>
</div>

<div id="js-summary" class="post_container-editor{{$post->type == pageType()->temporal ? '' : ' hidden'}}">
    <h3 class="post_container-title pl-4">
        <span class="icon-circle-up" id="js-toggle_summary" title="Hide panel"></span>&nbsp&nbsp;Summary
    </h3>
    <div id="js-summary_slider">
        <textarea class="js-post-content" name="summary" id="summary" cols="30" rows="15">{{ old('summary') ?? $post->summary }}</textarea>
    </div>
</div>

<div class="post_container-editor">
    <span></span><h3 class="post_container-title pl-4">Page content</h3>
    <textarea class="" name="body" id="js-post-content" cols="30" rows="45">{{ old('body') ?? $post->body }}</textarea>
</div>

