@extends("layouts.app")

@if(isset($categoryName))
    @section("title", $categoryName)
@else
    @section("title", "Home")
@endif

@section("content")
<div class="py-8 container">
    <h1 class="text-3xl font-semibold mb-4 ml-1"> @if(isset($categoryName)) Category : {{$categoryName}} @else All  @endif</h1>
    <div id="selected-category" class="text-3xl font-semibold mb-4"></div>




    <p>
        <!-- <a href="{{ route('posts.create') }}" title="Créer un article" class="text-blue-500 font-semibold underline">Créer un nouveau post</a> -->
    </p>

    <div class="mt-8 p-10 border flex">
        <div class="w-75 ">
            @foreach ($posts as $post)
            <div class="md:flex  mt-2 rounded-xl shadow-md overflow-hidden">
                <div class="md:shrink-0">
                    <img src="{{ $post->picture }}" class="h-48 w-full object-cover md:h-full md:w-48" alt="Image de couverture" >
                </div>
                <div class="p-8">

                    <p class="text-gray-500 text-sm"><a href="{{ route('categories.show', ['id' => $post->category_id]) }}" class="text-black hover:text-black-400">{{ $post->category_name }}</a></p>
                    <p class="text-gray-500 text-sm">{{$post->created_at}}</p>

                    <h1 class="uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $post->title }}</h1>

                    <!-- <img src="{{ asset('storage/'.$post->picture) }}" alt="Image de couverture" style="max-width: 300px;"> -->

                    <div class="mt-2 text-slate-500 line-clamp-3">{{ $post->content }}</div>

                    <p><a href="{{ route('posts.show',$post) }}" title="Retourner aux articles" class="mt underline hover:text-blue-500">Continue</a></p>
                </div>
            </div>
            @endforeach
        </div>
        <div class="d-flex flex-grow-1 ml-4 border " style=";width:40%">
            <!-- Advertisements content goes here -->
            <p>Advertisements</p>
        </div>


    </div>
    <div class="pagination">
        {{ $posts->appends(request()->query())->onEachSide(2)->links() }}

    </div>

</div>
@endsection
