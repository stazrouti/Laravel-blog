@extends("layouts.app")
@section("title", "Sign in")
@section("content")
<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6  bg-white rounded shadow-md" style="margin-top :-50px;">
        <h2 class="text-2xl font-semibold mb-4">Sign In</h2>
        
        <form action="{{ route('Sign-in') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 p-2 border rounded w-full @error('email') border-red-500 @enderror" value="{{ old('email') }}" required autofocus>
                @error('email')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="mb-4">
                <label for="password" class="block font-medium text-gray-700">Password</label>
                <input type="password" name="password" id="password" class="mt-1 p-2 border rounded w-full @error('password') border-red-500 @enderror" required>
                @error('password')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" class="text-blue-500 border-gray-300" name="remember">
                    <span class="ml-2 text-gray-600">Remember me</span>
                </label>
                
                <!-- <a class="{{ route('posts.index') }}" class="text-blue-500 hover:underline">Forgot Password?</a> -->
            </div>

            <div class="text-center">
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Sign In</button>
            </div>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400 mt-3">
                      Don’t have an account yet? <a href="{{ route('Sign-up')}}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
            </p>
        </form>
    </div>
</div>
@endsection

