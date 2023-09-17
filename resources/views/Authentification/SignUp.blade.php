@extends("layouts.app")
@section("title", "Sign Up")
@section("content")

<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded shadow-md" style="margin-top :-50px;">
        <h2 class="text-2xl font-semibold mb-4">Sign Up</h2>
        
        <form action="{{ route('Sign-up') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 p-2 border rounded w-full @error('name') border-red-500 @enderror" value="{{ old('name') }}" required autofocus>
                @error('name')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" class="mt-1 p-2 border rounded w-full @error('email') border-red-500 @enderror" value="{{ old('email') }}" required>
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

            <div class="mb-4">
                <label for="password_confirmation" class="block font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="mt-1 p-2 border rounded w-full" required>
            </div>

            <div class="text-center">
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Sign Up</button>
            </div>
            <p class="text-sm font-light text-gray-500 dark:text-gray-400 mt-3">
                      Already have an account ? <a href="{{ route('Sign-in')}}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign In</a>
            </p>
        </form>
    </div>
</div>
@endsection('content')