<div>
    <div class="pt-4 pb-2">
        <input
                wire:model="search"
                type="search"
                placeholder="Search by name"
                class="p-2"
        >
    </div>
    <table class="responsive_table px-4">
        <thead>
        <tr>
            <th class="text-left">Name</th>
            <th class="text-center w-20">Post count</th>
        </tr>
        </thead>
        <tbody>
        @forelse($authors as $author)
            <tr>
                <td data-label="Name">
                    <a href="{{ route('authors.show', $author->slug) }}">{{ $author->name }}</a>
                </td>
                <td class="text-center" data-label="Post count">
                    {{$author->posts_count}}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="text-center">[ No authors returned ]</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
<div class="text-center">{{ $authors->links('pagination.pagination') }}</div>