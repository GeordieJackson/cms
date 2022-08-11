@extends('dashboard.layout')
@section('head')
    <h1 class="text-4xl">Permissions management</h1>
@endsection
@section('content')
    <div class="container-lg mx-auto">
        <h2 class="text-2xl mb-2">Add a new permission</h2>
        <table class="responsive_table">
            <thead>
            <tr>
                <th class="text-left">Name</th>
                <th colspan="2" class="text-left">Description</th>
                <th>Add</th>
            </tr>
            </thead>
            <tbody>
            <form action="{{ route('dashboard.permissions.store') }}" method="post">
                @csrf
                <tr>
                    <td class="w-3/12"><input type="text" name="name" placeholder="name" required></td>
                    <td class="w-7/12"><input type="text" name="description" placeholder="description" value=""></td>
                    <td colspan="2" class="w-2/12 text-center">
                        <button class="btn-sm btn-primary">Add</button>
                    </td>
                </tr>
            </form>
            </tbody>
        </table>
        <h2 class="text-2xl mt-16 mb-2">Edit or delete a permission: <span class="text-base">Click in table cell to edit entry.</span>
        </h2>
        <table class="responsive_table" id="dt">
            <thead>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Description</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @forelse($permissions as $permission)
                <tr>
                    <form action="{{ \route('dashboard.permissions.update', $permission->id) }}" method="post">
                        @csrf
                        @method('put')
                        <td class="w-3/12"><input type="text" name="name" value="{{ $permission->name }}" required></td>
                        <td class="w-7/12"><input type="text" name="description" value="{{ $permission->description }}"></td>
                        <td class="w-1/12 text-center">
                            <button class="btn-sm btn-primary">Update</button>
                        </td>
                    </form>
                    <td class="w-1/12 text-center">
                        <form action="{{ \route('dashboard.permissions.destroy', $permission->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="4">[ No permissions set ]</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
@section('js')
    @parent
@endsection
@endsection
