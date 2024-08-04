@extends("layouts.app")
@section("title", $post->title)
@section("content")
@if (session('warning'))
<div class="alert alert-warning">
    <script>

        Swal.fire({
        title: 'Sign in required?',
        text: "Sign in to comment!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sign-in'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "/sign-in"; // Redirect to the sign-in page
        }
        });
    </script>
</div>
@endif
<div class="mt-8 p-10 border flex">
    <div class="w-75 border "style="width:100%">
        <h1 class="mt-5 mb-5 uppercase tracking-wide text-sm text-indigo-500 font-semibold">{{ $post->title }}</h1>
        <img src="{{ $post->picture }}" class="h-48 w-full object-cover md:h-80 md:w-100"  alt="Image de couverture">
        <p class="text-gray-500 text-sm"><a href="{{ route('categories.show', ['id' => $post->category_id]) }}" class="text-black hover:text-black-400">{{ $post->category_name }}</a></p>
        <p class="text-gray-500 text-sm ml-2">  
            @if (Auth::check() )
            <form method="POST" action="{{ route('Like.UpdateLike',['id'=>$post->id])}}">
            
                @csrf
                @method('PUT')
                <button class="delete-button" >
                    @if($userLiked)
                        <i class="fa-solid fa-heart text-red-500"></i>{{ $post->likes }}
                    @else
                        <i class="fa-regular fa-heart"></i>{{ $post->likes }}
                    @endif
               
            </form>
            
            @else
            
                <i class="fa-regular fa-heart"></i> : {{ $post->likes }}
            @endif
            <!--<div class="post @if ($userLiked) liked @endif">
             Post content -->

            <!-- @if ($userLiked)
                <p>You have liked this post!</p>
            @else
                <p>You have not liked this post.</p>
            @endif 
            </div>-->

        </p>
        <p class="text-gray-500 text-sm ml-2">publish date:{{ $post->created_at }}</p>
        <div class="m-2 text-slate-500 w-75 text-2xl leading-relaxed ">{{ $post->content }}</div>
        
    </div>
    <div class="d-flex flex-grow-1 ml-4 border " style="width:40%">
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
<div class="mt-6 w-3/4 p-10">
    @forelse ($comments as $comment)
        <div class="bg-gray-100 p-3 rounded-lg mb-2 relative flex">
            <div class="flex-grow"> <!-- Create a flex container to push content to the left -->
                <p class="text-gray-500 text-xs">{{ $comment->created_at }}</p>
                <p class="text-gray-600 text-xs">{{ $comment->name }}</p>
                <p class="text-sm">{{ $comment->body }}</p>
                <!-- <p class="text-sm">{{ $comment->cmid }}</p> -->
            </div>
                    
            @if (Auth::check() && $comment->user_id === Auth::user()->id)
            <form method="POST" action="{{ route('comments.destroy', ['comment' => $comment->id]) }}">
                <?php //dd($comment->id); ?>
            
                @csrf
                @method('DELETE')
                <button class="delete-button" data-action="{{ route('comments.destroy', ['comment' => $comment->id]) }}"><i class="fa-solid fa-trash text-red-500 cursor-pointer"></i></button>
            </form>
            <!-- <div> 
                <i class="fa-solid fa-trash text-red-500 cursor-pointer"></i>
            </div> -->
            @endif
        </div>
    @empty
        <!-- No comments to display -->
    @endforelse




    <form action="{{ route('comments.store') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="post_id" value="{{ $post->id }}">
        <textarea name="body" rows="3" placeholder="Add a comment..." required class="w-full border p-2 rounded-lg focus:outline-none focus:ring focus:border-blue-300"></textarea>
        <button type="submit" class="bg-blue-500 text-white py-2 px-4 mt-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring focus:bg-blue-300">Submit</button>
    </form>
</div>

@endsection
