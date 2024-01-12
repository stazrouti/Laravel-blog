@extends("layouts.app")

@if(isset($categoryName))
    @section("title", $categoryName)
@else
    @section("title", "Home")
@endif

@section("content")
<div class="py-8 container">
    <h1 class="text-3xl font-semibold mb-4 ml-1"> @if(isset($categoryName)) Category : {{$categoryName}} @endif</h1>

    <p>
        <!-- <a href="{{ route('posts.create') }}" title="Créer un article" class="text-blue-500 font-semibold underline">Créer un nouveau post</a> -->
    </p>
    @if(isset($categoryName)) 
    <form action="{{ route('categories.show', ['id' => $id]) }}" method="GET" class="mb-4">

    @else
        <form action="{{ route('posts.index') }}" method="GET" class="mb-4">
    @endif
        <!-- Other filter options (e.g., category) -->

        <!-- Filter by Date -->
        <label for="date" class="mr-2">Order By:</label>
        <select name="OrderValue" id="OrderValue">
            <option value="Newest">Newest</option>
            <option value="Oldest">Oldest</option>
            <option value="Likes">Like</option>
        </select>

        
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
    </form>
    <div class="mt-8 p-10 border flex">

        <div class="w-4/6 ">
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
        <div class="d-flex flex-grow-1 ml-5  w-2/6 h-fit" style="">
            <!-- Advertisements content goes here -->
            <!-- <p>Advertisements</p> -->
            <div class="mt-3 " >
                <img style="height:300px" class="w-full rounded" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEiGyLSrFdNKMjbVDTm4Ss3eFGguRdcvpwmell0qAdxQ&s">
            </div>
            <div  class="mt-3 " >
                <img style="height:300px" class="w-full" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEiGyLSrFdNKMjbVDTm4Ss3eFGguRdcvpwmell0qAdxQ&s">
            </div>
            <div class="mt-3" >
                <img style="height:300px" class="w-full" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQEiGyLSrFdNKMjbVDTm4Ss3eFGguRdcvpwmell0qAdxQ&s">
            </div>
        </div>


    </div>
    <div class="pagination mt-1">
        {{ $posts->appends(request()->query())->onEachSide(2)->links() }}

    </div>

</div>
@endsection
