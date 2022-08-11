<div class="pl-16 pr-4">
    <div class="pt-4 pb-2">
        <input
                wire:model="search"
                type="search"
                placeholder="Filter by title"
                class="p-2 w-33"
        >
    </div>
    <div>
        <table class="responsive_table">
            <thead>
            <tr>
                <th class="text-left w-2/3">Title</th>
                <th class="text-left w-1/3">Posted in</th>
            </tr>
            </thead>
            <tbody>
            @forelse($posts as $post)
                <tr>
                    <td data-label="Title" class="w-66">
                        @if($post->type == pageType()->categorized)
                            <a class="blog-item-link" href="{{ route('post', $post->slug) }}">{{ $post->title }}</a>
                        @else
                            <a class="blog-item-link"
                               href="{{ route('temporal.show', [$post->temporal->slug, $post->slug]) }}">{{ $post->title }}</a>
                        @endif
                    </td>
                    <td data-label="Posted in" class="w-33">
                        @if($post->type == pageType()->categorized)
                            <a href="{{ route('categories.show', $post->category->slug) }}">{{ display($post->category->name, 'w') }}</a>
                        @elseif($post->type == pageType()->temporal)
                            <a href="{{ route('post', $post->temporal->slug) }}">{{ display($post->temporal->slug, 'w') }}</a>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">[ No articles returned ]</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $posts->links('pagination.pagination') }}
</div>