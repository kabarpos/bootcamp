@extends('layouts.public')

@section('content')
<div class="min-h-screen bg-background">
    <x-public.breadcrumb :items="[
        ['label' => 'Home', 'url' => route('public.homepage')],
        ['label' => 'Blog', 'url' => '#'],
        ['label' => $post->title, 'url' => '#']
    ]" />
    
    <div class="py-12 bg-card/80 backdrop-blur-sm">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <article>
                <h1 class="text-3xl font-extrabold text-foreground lg:text-4xl">
                    {{ $post->title }}
                </h1>
                
                <div class="mt-4 flex items-center">
                    <div class="flex-shrink-0">
                        <span class="sr-only">{{ $post->author->name ?? 'Author' }}</span>
                        <div class="h-10 w-10 rounded-full bg-primary/10 flex items-center justify-center">
                            <span class="text-primary font-bold">{{ substr($post->author->name ?? 'A', 0, 1) }}</span>
                        </div>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-foreground">
                            {{ $post->author->name ?? 'Author' }}
                        </p>
                        <div class="flex space-x-1 text-sm text-muted-foreground">
                            <time datetime="{{ $post->published_at }}">
                                {{ $post->published_at->format('M d, Y') }}
                            </time>
                            <span aria-hidden="true">
                                &middot;
                            </span>
                            <span>
                                {{ str_word_count($post->content) }} words
                            </span>
                        </div>
                    </div>
                </div>
                
                <div class="mt-6 text-muted-foreground">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </article>
        </div>
    </div>
</div>
@endsection