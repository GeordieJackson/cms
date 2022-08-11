@extends('front.layout')
@section('display')
    <div class="display">

        <div class="display-content">
            @yield('content')
        </div>
        <x-sidebar class="display-sidebar-right">

            {{--            Search box--}}
            {{--            <x-search></x-search>--}}

            {{--            Tags for blogs--}}
            @if(isset($tagList) && $tagList)
                <x-tags :tagList="$tagList"></x-tags>
            @endif

            {{--            Tag cloud for blogs--}}
            @if(isset($tagCloud) && $tagCloud)
                <x-tag-cloud :tagCloud="$tagCloud"></x-tag-cloud>
            @endif

            {{--            Display subcategories for a category with posts and subcategories--}}
            @if(isset($subCategories) && $subCategories )
                <x-subcategories :menu="$subCategories" :category="$category"></x-subcategories>
            @endif

            {{--            Search tips--}}
            @if( url()->current() == route('search') )
                <x-search-tips></x-search-tips>
            @endif


        </x-sidebar>


    </div>
@endsection
