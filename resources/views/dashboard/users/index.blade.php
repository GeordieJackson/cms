@extends('dashboard.layout')
@section('head')
    <h1 class="text-4xl">User management</h1>
@endsection
@section('content')
    <div class="container-xl mx-auto">
        @include('dashboard.posts.includes.errors')

        <table class="responsive_table" id="dt">
            <thead>
            <tr>
                <th class="text-left">First name</th>
                <th class="text-left">Surname</th>
                <th class="text-left">Slug</th>
                <th class="text-left">email</th>
                <th class="text-left">Roles</th>
                <th class="text-center">Verified</th>
                <th class="text-center">Edit</th>
                <th class=text-center">Delete</th>
            </tr>
            </thead>
            <tbody>
            @forelse($users as $user)
                <tr>
                    <td class="w-2/12">{{$user->forename}}</td>
                    <td class="w-2/12">{{$user->surname}}</td>
                    <td class="w-2/12">{{$user->slug}}</td>
                    <td class="w-2/12">{{$user->email}}</td>
                    <td class="w-1/12 text-left">
                        @foreach($user->roles->pluck('name') as $role)
                            @if($loop->index)
                                <br/>
                            @endif
                            {{ $role }}
                        @endforeach
                    </td>
                    <td class="w-1/12 text-center">{{$user->email_verified_at ? 'Yes' : 'No'}}</td>
                    <td class="w-1/12 text-center"><a href="{{ route('dashboard.users.edit', $user->id) }}">
                            <button class="btn-sm btn-success">Edit</button>
                        </a></td>
                    <td class="w-1/12 text-center">
                        <form method="post" action="{{ route('dashboard.users.destroy', $user->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan=7">[ No users entered ]</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
@section('js')
    @parent
@endsection
@endsection
