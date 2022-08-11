@extends('dashboard.layout')
@section('head')
    <h1 class="text-4xl">Categories management</h1>
@endsection
@section('content')
    <div class="container mx-auto">
        @include('dashboard.posts.includes.errors')
        <div class="post_container">
            <div class="post_container-main">
                <table class="responsive_table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Parent</th>
                        <th class="text-right">Update</th>
                        <th class="text-left">Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <form action="{{ route('dashboard.categories.store') }}" method="post">
                            @csrf
                            <td class="px-4 py-2 text-center w-4/12">
                                <input class="p-2" type= text" name="name" id="add_name">
                            </td>
                            <td class="px-4 py-2 text-center w-4/12">
                                <select class="p-2" name="category_id">
                                    <option value="0">None</option>
                                    @foreach($categories as $dropdown)
                                        <option value="{{$dropdown->id}}">{{$dropdown->display_name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td colspan="2" class="text-center w-4/12">
                                <button class="btn-sm btn-success" id="add_submit">&nbsp;&nbsp;Add new category [+]&nbsp;&nbsp;</button>
                            </td>
                        </form>
                    </tr>
                    @forelse($categories as $category)
                        <tr>
                            <form action="{{route('dashboard.categories.update', $category->id)}}" method="post">
                                {{csrf_field()}}
                                @method('patch')
                                <input type="hidden" name="id" value="{{$category->id}}">
                                <td class="px-4 py-2 text-center">
                                    <input class="p-2" type="text" name="name" id="{{$category->name}}"
                                           value="{{$category->display_name}}"></td>
                                <td class="px-4 py-2 text-center">
                                    <select class="p-2" name="category_id">
                                        <option value="0">None</option>
                                        @foreach($categories as $dropdown)
                                            @if($category->getIdList()->contains($dropdown->id) )
                                                @continue
                                            @endif
                                            <option value="{{$dropdown->id}}"
                                            @if($dropdown->id == $category->category_id)
                                                {!! ' selected' !!}
                                                    @endif
                                            >{{$dropdown->display_name}}</option>
                                        @endforeach
                                    </select></td>
                                <td class="text-right w-2/12">
                                    <button id="{{$category->name}}-update" class="btn-sm btn-primary">Update</button>
                                </td>
                            </form>
                            <td class="text-left w-2/12">
                                <form action="{{route('dashboard.categories.destroy', $category->id)}}"
                                      method="post">
                                    {{csrf_field()}}
                                    @method('delete')
                                    <input type="hidden" name="id" value="{{$category->id}}">
                                    <input type="hidden" name="category_id" value="{{$category->category_id}}">
                                    <input type="hidden" name="name" value="{{$category->name}}">
                                    <button id="{{$category->name}}-delete" class="btn-sm btn-danger">Delete
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td class="text-center text-bold" colspan="4"> [ No categories set ]</td>
                        </tr>
                    @endforelse
                    </tbody>

                </table>
            </div>

            <table class="responsive_table ml-4">
                <thead>
                <tr><th style="height: 1.1rem">Output tree</th></tr>
                </thead>
                <tbody>
                <tr class="responsive_table--no-hover">
                    <td style="vertical-align: top; padding-left: 10%;">
                        {!! $categoryTree !!}
                    </td>
                </tr>
                </tbody>
            </table>


        </div>

    </div>
@section('js')
    @parent
@endsection
@endsection
