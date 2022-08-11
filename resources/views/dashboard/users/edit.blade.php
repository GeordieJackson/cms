@extends('dashboard.layout')
@section('meta')
@endsection

@section('head')
    <h1 class="text-4xl">User Profile</h1>
@endsection
@section('content')
    <div class="container-lg mx-auto">
        <h1>View/Edit profile: {{$user->name}}</h1>
        <div class="form-container">
            @include('dashboard.posts.includes.errors')
            <form class="form" action="{{ route('dashboard.users.update', $user->id) }}" method="post">
                @method('PATCH')
                @csrf
                <div class="form-row">
                    <label class="form-row-label" for="forename">Forename: </label>
                    <input class="form-row-input" type=text name="forename" id="forename" value="{{$user->forename}}">
                    <label class="form-row-label" for="surname">Surname: </label>
                    <input class="form-row-input" type="text" name="surname" id="surname" value="{{$user->surname}}">
                </div>
                <div class="form-row">
                    <label class="form-row-label" for="email">E-mail: </label>
                    <input class="form-row-input" type="email" name="email" id="email" value="{{$user->email}}">
                </div>
                @can('manage.users')
                    <div class="form-row">
                        <label class="form-row-label" for="verified">E-mail verified: </label>
                        <div class="flex">
                            <input class="form-radio" type="radio" id="yes"
                                   name="verified" {{$user->email_verified_at ? ' checked' : ''}}>Yes&nbsp;&nbsp;
                            <input class="form-radio" type="radio" id="no"
                                   name="verified" {{ ! $user->email_verified_at ? ' checked' : ''}}>No
                        </div>
                    </div>
                    <div class="form-row">
                        <label class="form-row-label" for="roles">Role</label>
                        <div class="form-row-input">
                            <select name="roles" id="roles">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if($user->roles->contains($role->id)) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endcan
                <div class="form-row justify-end">
                    <button type="submit" class="btn-sm btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    @parent
@endsection
