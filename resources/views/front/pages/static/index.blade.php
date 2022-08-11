@extends('front.type.plain')
@section('content')
    <main>
        <div class="display mt-8">
            <div class="display-content">
                <header class="homepage-header">
                    <h1>Critical Thinking</h1>
                    <p>Introductory level critical thinking: how to think about claims, arguments, or
                        issues in a systematic way that leads to better conclusions and understanding. </p>
                </header>
                <div class="prose p-4">
                    {!! $content->body ?? '' !!}
                </div>
            </div>
            <div class="display-sidebar-right">
                <div class="headings-title  mb-8">
                    <h4><span>Latest post<?php if ($latestPosts->count() != 1) {
                                echo('s');
                            } ?></span></h4>
                </div>
                <div>
                    @forelse($latestPosts as $post)
                        <article class="listing_sidebar">
                            <div>
                                @if($post->image)
                                    <a href="{{ url($post->temporal->slug ?? '', $post->slug) }}">
                                        <img class="listing_sidebar-img" src="{{ asset('storage/images/' . $post->image) }}" alt="">
                                    </a>
                                @endif
                            </div>

                            <div class="listing_sidebar-body">
                                <div class="listing_sidebar-title">
                                    <a href="{{ url($post->temporal->slug ?? '', $post->slug) }}">
                                        <h1>{{ display($post->title, 'f')}}</h1>
                                    </a>
                                </div>
                                <div class="listing_sidebar-subtitle">
                                    {!! $post->meta_description !!}
                                </div>
                            </div>
                        </article>
                    @empty
                        <p class="text-center">[ No content yet ]</p>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
@endsection
