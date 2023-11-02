@extends("layouts.app")
@section("title", "Sign Up")
@section("content")

<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-6 bg-white rounded shadow-md" style="margin-top :-50px;">
        <h3 class="text-2xl font-semibold mb-4">Pleaz check your email we send you a verification code</h3>
        <h2 class="text-2xl font-semibold mb-4">verification code</h2>
        <form method="post" action="{{ route('verify.email') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block font-medium text-gray-700">Enter the verification code :</label>
                <input type="text" id="verification_code" class="mb-2 mt-1 p-2 border rounded w-full" name="verification_code" required>
                <div class="text-center">
                    <button type="submit" class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Verify</button>
                </div>

            </div>
            
        </form>
    </div>
</div>
@endsection('content')
