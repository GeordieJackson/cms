@extends('dashboard.layout')
@section('meta')
    <style>
        select {
            border: 1px solid #999;
            transform: scale(1.2);
        }
    </style>
@endsection
@section('head')
    <h1 class="text-4xl">Assign permissions to roles</h1>
@endsection
@section('content')
    <div style="width: 12rem; margin: 0 auto;">
        <h2 class="mb-4 text-center">Select a role</h2>
        <form action="{{ route('dashboard.assign.setRole') }}" method="post" class="text-center">
            @csrf
            <div class="form-row">
                <select name="role_id">
                    <option value="0">None</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <button class="btn-sm btn-primary mt-2" type="submit">Select...</button>
        </form>
    </div>
@section('js')
    @parent
@endsection
@endsection
