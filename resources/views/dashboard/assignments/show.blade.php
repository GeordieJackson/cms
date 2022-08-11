@extends('dashboard.layout')
@section('meta')
    <style>
        table {
            width: auto;
            margin: 0 auto;
            background: #f5f5f5;
        }

        th {
            background: #ccc;
            padding: 0.5rem 1rem;
            border: 1px solid #999;
        }

        td {
            padding: 0.5rem 1rem;
            border: 1px dashed #999;
        }

        tfoot td {
            border: none;
            border-top: 1px dashed #999;
            background: #fff;
        }

        input[type=checkbox] {
            transform: scale(1.35);
        }
    </style>
@endsection
@section('head')
    <h1 class="text-4xl">Assign permissions to roles</h1>
@endsection
@section('content')
    <div class="container mx-auto">
        <h2 class="text-2xl mb-2 text-center">Assign permissions to role: {{$role->name}}</h2>
        <br><br>
        <form action="{{ route('dashboard.assign.update', $role->id) }}" method="post">
            @csrf
            @method('put')
            <table class="table-fixed">
                <thead>
                <th class="w3/12">Permission</th>
                <th class="w8/12">Description</th>
                <th class="w1/12">Allow</th>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                    <tr>
                        <td style="border-right: 1px dashed #999">{{$permission->name}}</td>
                        <td style="border-right: 1px dashed #999">{{$permission->description}}</td>
                        <td class="text-center">
                            <input name="role_ids[]" type="checkbox" value="{{ $permission->id }}" {{ $setPermissions->contains($permission->id) ? ' checked': ''}}>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <td colspan="3" class="text-right">
                    <button type="submit" class="btn btn-primary">Update</button>
                </td>
                </tfoot>
            </table>

        </form>
    </div>
@section('js')
    @parent
@endsection
@endsection



