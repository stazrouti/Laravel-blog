@extends("layouts.app")
@section("title", "Contact Us")
@section("content")

<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded shadow-md" style="margin-top:-50px;">
        <h2 class="text-2xl font-semibold mb-4">Contact Us</h2>
        @if(session('success'))
            <div id="contact-alert" class="alert alert-success text-green-500">
            {{ session('success') }}
            
            </div>
            <div>
                <a href="{{session()->get('previous_url')}}" class="underline">Back</a>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger text-red-600">
                {{ session('error') }}
            </div>
            <div>
                <a href="{{session()->get('previous_url')}}" class="underline">Back</a>
            </div>
        @endif


        <form action="{{ route('Contact.submit') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700">Name</label>
                <input type="text" name="name" id="name" class="mt-1 p-2 border rounded w-full @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
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
                <label for="message" class="block font-medium text-gray-700">Subject</label>
                <textarea name="subject" id="subject" class="mt-1 p-2 border rounded w-full @error('message') border-red-500 @enderror" rows="4" required>{{ old('subject') }}</textarea>
                @error('message')
                <p class="text-red-500 text-xs">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
