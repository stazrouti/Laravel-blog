@extends("layouts.app")
@section("title", $post->title)
@section("content")
<div class="mt-10 max-w-md mx-auto bg-white rounded-xl shadow-md overflow-hidden md:max-w-2xl">
    <div class="md:flex">
        <div class="md:shrink-0">
            <img src="{{ $post->picture }}" class="h-48 w-full object-cover md:h-full md:w-48" alt="Image de couverture" >
        </div>
        <div class="p-8">
            <h1 class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $post->title }}</h1>

            <!-- <img src="{{ asset('storage/'.$post->picture) }}" alt="Image de couverture" style="max-width: 300px;"> -->

            <div class="mt-2 text-slate-500">{{ $post->content }}</div>

            <p><a href="{{ route('posts.index') }}" title="Retourner aux articles" class="mt underline hover:text-blue-500">Retourner aux posts</a></p>
        </div>
    </div>
</div>

@endsection