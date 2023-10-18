@extends("layouts.app")

@section("title", "About Us")

@section("content")
<div class="container mx-auto py-6">
    <h1 class="text-3xl font-semibold mb-4 p-3">About Us</h1>
    
    <div class="bg-white rounded-lg p-6 shadow-md">
        <h2 class="text-xl font-semibold mb-4">Our Mission</h2>
        <p class="text-gray-700">
            Welcome to our blog! We are dedicated to providing high-quality and informative content to our readers. Our mission is to share knowledge and insights on a wide range of topics that matter to you. We believe in making information accessible and helping you stay informed.
        </p>
        
        <h2 class="text-xl font-semibold mt-6">Meet the Team</h2>
        <ul class="list-disc list-inside text-gray-700 pl-4">
            <li><strong>John Doe</strong> - Founder and Content Creator</li>
            <li><strong>Jane Smith</strong> - Editor and Contributor</li>
            <li><strong>Michael Johnson</strong> - Senior Writer</li>
            <!-- Add more team members as needed -->
        </ul>
        
        <h2 class="text-xl font-semibold mt-6">Our Values</h2>
        <p class="text-gray-700">
            At our blog, we value accuracy, integrity, and continuous learning. We strive to deliver well-researched and thought-provoking content that you can trust. We are committed to maintaining a diverse and inclusive platform that welcomes different perspectives and ideas.
        </p>
        
        <h2 class="text-xl font-semibold mt-6">Contact Us</h2>
        <p class="text-gray-700">
            If you have any questions, feedback, or would like to get in touch, please feel free to contact us via our <a href="/Contact" class="text-blue-500 hover:underline">contact form</a>. We appreciate your engagement and look forward to hearing from you.
        </p>
    </div>
</div>
@endsection
