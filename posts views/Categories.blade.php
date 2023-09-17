<div class="scroll-container hidden md:flex">
    <button id="scroll-left" class="scroll-button scroll-left"><i class="fa-solid fa-square-caret-left"></i></button>
    <div class="categories-container">
        <ul class="hidden md:flex space-x-5">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', ['id' => $category->id]) }}" class="text-black hover:text-black-400">{{ $category->name }}</a>
            @endforeach
        </ul>
    </div>
    <button id="scroll-right" class="scroll-button scroll-right"><i class="fa-solid fa-square-caret-right"></i></button>
</div>

