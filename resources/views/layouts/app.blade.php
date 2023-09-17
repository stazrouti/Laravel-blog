<!-- {{-- resources/views/layouts/app.blade.php --}} -->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

	<!-- Le titre de la page -->
	<title>@yield("title")</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

</head>
<body>
	<!-- navbar -->
	<nav class="bg-blue-500 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{route('posts.index')}}" class="text-white text-lg font-semibold">Blog</a>
        
        <div class="hidden md:flex space-x-5">
            <a href="{{ route('posts.index') }}" class="text-white hover:text-gray-300">Home</a>
            <a href="#" class="text-white hover:text-gray-300">About</a>
            <a href="#" class="text-white hover:text-gray-300">Services</a>
            <a href="#" class="text-white hover:text-gray-300">Contact</a>
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
    <footer class="bg-gray-800 text-white py-6">
    <div class="container mx-auto flex justify-between items-center">
        <div class="text-lg font-semibold">
            Your Company Name
        </div>
        <div class="space-x-4">
            <a href="#" class="hover:text-gray-400">Home</a>
            <a href="#" class="hover:text-gray-400">About</a>
            <a href="#" class="hover:text-gray-400">Services</a>
            <a href="#" class="hover:text-gray-400">Contact</a>
        </div>
        <div class="flex items-center space-x-4">
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