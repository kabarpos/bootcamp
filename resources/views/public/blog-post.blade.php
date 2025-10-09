@extends('layouts.public')

@section('content')
<x-public.breadcrumb :items="[
    ['label' => 'Home', 'url' => route('public.homepage')],
    ['label' => 'Blog', 'url' => '#'],
    ['label' => $post->title, 'url' => '#']
]" />

<x-public.hero-section 
    :titleLine1="$post->title"
    titleLine2="Insights & Stories"
    :description="strip_tags(\\Illuminate\\Support\\Str::limit($post->content, 160))"
    :stats="[
        ['label' => 'Published', 'value' => $post->published_at->format('M d, Y')],
        ['label' => 'Author', 'value' => $post->author->name ?? 'Author'],
        ['label' => 'Length', 'value' => str_word_count($post->content) . ' words']
    ]"
/>

<section class="relative py-24">
    <div class="absolute inset-0 bg-[radial-gradient(circle_at_top,_rgba(99,102,241,0.12),_transparent_65%)]"></div>
    <div class="relative mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
        <article class="glass-card rounded-[30px] p-8 leading-relaxed text-sm text-slate-300">
            <span class="spotlight-ring"></span>
            {!! nl2br(e($post->content)) !!}
        </article>
    </div>
</section>
@endsection
