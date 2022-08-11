@extends('front.type.right-sidebar')
@section('content')
    <header class="headings-page">
        <div class="headings-page-spacer"></div>
        <div class="headings-page-body">
            <h1>Active Categories</h1>
            <div class="headings-page-spacer-b"></div>
        </div>
    </header>
    @if($categories->count())
        <table class="responsive_table w-2/3 mx-auto">
            <thead>
            <tr>
                <th class="text-left">Category</th>
                <th>Post count</th>
            </tr>
            </thead>
            <tbody>
            @forelse($categories as $category)
                <tr>
                    <td data-label="Category" class="w-75"><a
                                href="{{ route('categories.show', $category->slug) }}">{{ display($category->name, 'w') }} </a></td>
                    <td data-label="Post count" class="w-25 text-center">{{ $category->count }}</td>
                    @empty
                        No categories set
                </tr>
            @endforelse

            </tbody>
        </table>
    @endif
@endsection
