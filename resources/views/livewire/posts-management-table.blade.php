<div>
    <table class="responsive_table" id="dt">
        <thead>
        <tr>
            <th class="text-left">Title</th>
            <th class="text-left">Author</th>
            <th class="text-left">Type</th>
            <th class="text-center">Published</th>
            <th class="text-right">Publication Date</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                <input class="p-2 w-two-thirds" wire:model="searchTerm" type="search" placeholder="Filter by title">
            </td>
            <td>
                <select wire:model="authorId" name="authors" class="pl-2 pr-4 w-full py-1">
                    @if($authors->count() > 1)
                        <option value="0">All</option>
                    @endif
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select wire:model="typeId" name="types" class="pl-2 pr-4 w-full py-1">
                    <option value="0">All</option>
                    @foreach(pageType() as $type => $value)
                        <option value="{{ $value }}">{{ display($type, 'f') }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <select wire:model="publishedId" name="published" class="pl-2 pr-4 w-full py-1">
                    <option value="2">All</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @forelse($posts as $post)
            <tr>
                <td>{{ $post->title }}</td>
                <td class="text-right">{{ $post->owner->name ?? ''}}</td>
                <td class="text-right">{{ ucfirst($post->typeName) }}
                    @if($post->type == 1 && isset($post->temporal->name))
                        [{{ $post->temporal->name}}]
                    @endif
                </td>
                <td class="text-center">{{ $post->published ==1 ? "Yes" : "No"}}</td>
                <td class="text-right">{{ publicationDateTime($post->publication_date) }}</td>
                <td class="text-center">
                    <a href="{{ route('dashboard.posts.edit', $post->id) }}">
                        <button type="submit" class="btn-sm btn-primary">Edit</button>
                    </a>
                </td>
                <td class="text-center">
                    <form action="{{ route('dashboard.posts.destroy', $post) }}" method="post">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">[ No posts found ]</td>
            </tr>
        @endforelse
        </tbody>
        <tfoot>
        </tfoot>
    </table>
    {{ $posts->links('pagination.pagination') }}
</div>