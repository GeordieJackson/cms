<div>
    <div class="search">
        <form x-data="{}" @submit.prevent>
            <div class="flex justify-between"><label for="search">Search filter</label><button wire:click="clearSearch" class="btn-xs btn-secondary">Clear</button></div>
            <input wire:model="searchTerm" type="search" id="search" name="search" placeholder="Enter search terms">
            @error('searchTerm')
            <div class="search-error">{{ $message }}</div>@enderror
        </form>
    </div>
    <table class="responsive_table mt-8">
        <thead>
        <tr>
            <th class="text-left">Title</th>
            <th class="text-left">Section</th>
            <th class="text-left">Author</th>
        </tr>
        </thead>
        <tbody>
        @forelse($posts as $post)
            <tr>
                <td data-label="Title">
                    @if($post->type == pageType()->categorized)
                        <a class="blog-item-link" href="{{ route('post', $post->slug) }}">{{ $post->title }}</a>
                    @else
                        <a class="blog-item-link"
                           href="{{ route('temporal.show', [$post->temporal->slug, $post->slug]) }}">{{ $post->title }}</a>
                    @endif
                </td>
                <td data-label="Section">
                    @if($post->type == pageType()->categorized)
                        <a href="{{ route('categories.show', $post->category->slug) }}">{{ display($post->category->name, 'w') }}</a>
                    @elseif($post->type == pageType()->temporal)
                        <a href="{{ route('post', $post->temporal->slug) }}">{{ display($post->temporal->slug, 'w') }}</a>
                    @endif
                </td>
                <td data-label="Author"><a href="{{ route('authors.show', $post->owner->slug) }}">{{ $post->owner->name }}</a></td>
            </tr>
        @empty
            <tr>
                <td class="responsive_table-no_results" colspan="3"><p>[ No results returned ]</p></td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $posts->links('pagination.pagination') }}
</div>