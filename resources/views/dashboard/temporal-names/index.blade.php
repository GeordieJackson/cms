@extends('dashboard.layout')
@section('head')
    <h1 class="text-4xl">Temporal sections management</h1>
@endsection
@section('content')
    <div class="container-sm mx-auto">
        @include('dashboard.posts.includes.errors')
        <h4>Add a new section</h4>
        <table class="responsive_table">
            <thead>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Slug</th>
                <th class="text-left">Active</th>
                <th colspan="2" >Add</th>
            </tr>
            </thead>
            <tbody>
            <form action="{{ route('dashboard.temporalNames.store') }}" method="post">
                @csrf
                <tr class="responsive_table--no-hover">
                    <td class="w-4/12"><input type="text" name="name" id="title" placeholder="slug" required></td>
                    <td class="w-4/12"><input type="text" name="slug" id="slug" placeholder="name" required></td>
                    <td class="w-2/12">
                        <select name="active" />
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </td>
                    <td colspan="2" class="w-2/12 text-center">
                        <button class="btn-sm btn-primary">Add</button>
                    </td>
                </tr>
            </form>
            </tbody>
        </table>
        <h4 class="mt-8 mb-2">Edit or delete a section:</h4>
        <table class="responsive_table">
            <thead>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Slug</th>
                <th class="text-left">Active</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @forelse($temporalNames as $temporalName)
                <tr class="responsive_table--no-hover">
                    <form action="{{ \route('dashboard.temporalNames.update', $temporalName->id) }}" method="post">
                        @csrf
                        @method('put')
                        <td class="w-4/12"><input type="text" name="name" value="{{ $temporalName->name }}" required></td>
                        <td class="w-4/12"><input type="text" name="slug" value="{{ $temporalName->slug }}" required></td>
                        <td class="w-2/12">
                            <select name="active" />
                            <option value="0" @if( $temporalName->active == 0)  selected="1" @endif>No</option>
                            <option value="1" @if( $temporalName->active) selected="1" @endif>Yes</option>
                        </td>
                        <td class="w-1/12 text-center">
                            <button class="btn-sm btn-primary">Update</button>
                        </td>
                    </form>
                    <td class="w-1/12 text-center">
                        <form action="{{ \route('dashboard.temporalNames.destroy', $temporalName) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="5" class="text-center">[ No temporal names set ]</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@section('js')
    @parent
@endsection
@endsection
