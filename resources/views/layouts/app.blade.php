<!-- {{-- resources/views/layouts/app.blade.php --}} -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="https://revenuearchitects.com/wp-content/uploads/2017/02/Blog_pic-1030x584.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- Le titre de la page -->
	<title>@yield("title")</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    @vite('resources/js/search.js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    





</head>
<body>
	<!-- navbar -->
	<nav class="bg-blue-500 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{route('posts.index')}}" class="text-white text-lg font-semibold">Blog</a>
        
        <div class="hidden md:flex space-x-5">
            <!-- search bar -->                
            <form class="form " id="search-form"  method="GET">
                <button>
                    <svg width="17" height="16" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="search">
                        <path d="M7.667 12.667A5.333 5.333 0 107.667 2a5.333 5.333 0 000 10.667zM14.334 14l-2.9-2.9" stroke="currentColor" stroke-width="1.333" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
                <input class="input" placeholder="Type your text"  required="" type="text">
                <button class="reset" type="reset">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </form>
            <div id="search-results" class="bg-white mt-10  w-50 rounded" style="position:absolute;left:25%"></div>

            
                        <!-- search bar -->
            <a href="{{ route('posts.index') }}" class="text-white hover:text-gray-300 mt-2">Home</a>
            <a href="/About" class="text-white hover:text-gray-300 mt-2">About</a>
            <!-- <a href="#" class="text-white hover:text-gray-300">Services</a> -->
            <a href="/Contact" class="text-white hover:text-gray-300 mt-2">Contact</a>
        </div>

        
        <div class="md:hidden">
            <button class="text-white">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        
        <div class="hidden md:block  ">
            @if(session()->has('UserEmail'))
                <a href="/Logout" class="text-white hover:bg-white p-2 hover:text-blue-500 rounded">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </a>    
            @else
            <a href="{{ route('Sign-in') }}" class="text-white hover:bg-white p-2 hover:text-blue-500 rounded">Sign In</a>
            @endif
        </div>
    </div>
</nav>
<div >
    @include('posts.Categories')
</div>

	<!-- Le contenu -->
	@yield("content")
    <!-- Footer  -->
    <footer class="bg-blue-500 text-white py-6">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-lg font-semibold pl-2">
            Blog
        </div>
        <div class="space-x-4">
            <a href="#" class="hover:text-gray-400">Home</a>
            <a href="About" class="hover:text-gray-400">About</a>
            <!-- <a href="#" class="hover:text-gray-400">Services</a> -->
            <a href="/Contact" class="hover:text-gray-400">Contact</a>
        </div>
        <div class="flex items-center space-x-4 mr-2">
            <a href="#" class="text-gray-400 hover:text-white">
                <i class="fab fa-facebook"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="text-gray-400 hover:text-white">
                <i class="fab fa-instagram"></i>
            </a>
        </div>
    </div>
</footer>


</body>
</html>