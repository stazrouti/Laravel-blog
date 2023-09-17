@section("title", "Tous les articles")
@section("content")
@extends("layouts.app")

<div class="py-8 container">
    <h1 class="text-3xl font-semibold mb-4">Tous les articles</h1>

    <p>
        <a href="{{ route('posts.create') }}" title="Créer un article" class="text-blue-500 font-semibold underline">Créer un nouveau post</a>
    </p>

    <div class="mt-8 p-10">
        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4">Titre</th>
                    <th class="py-2 px-4" colspan="2">Opérations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $post)
                <tr class="border">
                    <td class="py-2 px-4">
                        <a href="{{ route('posts.show', $post) }}" title="Lire l'article" class="text-blue-500 w-full">{{ $post->title }}</a>
                    </td>
                    <td class="py-2 px-4">
                        <a href="{{ route('posts.edit', $post) }}" title="Modifier l'article" class="text-green-500">Modifier</a>
                    </td>
                    <td class="py-2 px-4">
                        <form method="POST" action="{{ route('posts.destroy', $post) }}" class="inline">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="text-red-500">Supprimer</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
