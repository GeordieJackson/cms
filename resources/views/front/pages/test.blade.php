@extends('front.type.double-sidebar')
@section('content')
    <div
        x-data="{ display: false}"
        x-init="$refs.tick.classList.remove('hidden')"
    >
        <p class="mx-4 mt-4">AplineJS is
            <span x-show="display">NOT </span>
            working
            <span x-show="display">❌</span>
            <span x-ref="tick" class="hidden">✅</span>
        </p>
    </div>
@endsection
