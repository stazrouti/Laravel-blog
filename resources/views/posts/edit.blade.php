@extends("layouts.app")
@section("content")

<div class="max-w-2xl mx-auto py-8 ">
    @if (isset($post))
        <h1 class="text-2xl font-semibold hover:text-blue-500">Editer un post</h1>
        @section("title", "Editer un post")
    @else
        @section("title", "Créer un post")
        <h1 class="text-2xl font-semibold hover:text-blue-500">Créer un post</h1>
    @endif
    <a href="{{ route('posts.index') }}" class="text-2xl font-semibold underline hover:text-blue-500">Retourner</a>


    <form class="mt-4" method="POST" action="{{ isset($post) ? route('posts.update', $post) : route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        @method(isset($post) ? 'PUT' : 'POST')

        <div class="mb-4">
            <label for="title" class="block font-medium  text-sky-500">Titre</label>
            <input type="text" name="title" value="{{ isset($post->title) ? $post->title : old('title') }}" id="title" placeholder="Le titre du post"
                class="mt-1 p-2 border rounded w-full @error('title') border-red-500 @enderror">
            @error("title")
            <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        @if(isset($post->picture))
        <div class="mb-4">
            <span class="block font-medium  text-sky-500" >Couverture actuelle</span>
            <!-- <img src="{{ asset('storage/'.$post->picture) }}" alt="image de couverture actuelle" class="mt-1 w-full h-auto max-h-48"> -->
            <img src="{{ ($post->picture) }}" alt="image de couverture actuelle" class="mt-1 w-full h-auto max-h-48">
        </div>
        @endif

        <div class="mb-4">
            <label for="picture" class="block font-medium  text-sky-500">Couverture</label>
            <input type="file" name="picture" id="picture"
                class="mt-1 p-2 border rounded w-full @error('picture') border-red-500 @enderror">
            @error("picture")
            <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="content" class="block font-medium  text-sky-500">Contenu</label>
            <textarea name="content" id="content" lang="fr" rows="5" cols="30" placeholder="Le contenu du post"
                class="mt-1 p-2 border rounded w-full @error('content') border-red-500 @enderror">{{ isset($post->content) ? $post->content : old('content') }}</textarea>
            @error("content")
            <p class="text-red-500 text-xs">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Valider</button>
    </form>
</div>

@endsection
