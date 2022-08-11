@if($category->show)
    <ul>
        <li>{{ $category->name . " [" . $category->count . "]"}}</li>
        @if ($category->descendants)
            @foreach ($category->descendants as $childCategory)
                @include('public.categories.child_category', ['category' => $childCategory])
            @endforeach
        @endif
    </ul>
@endif
