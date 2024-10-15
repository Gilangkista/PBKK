<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <h3 class="text-xl">Ini Halaman Blog</h3>

    <article class="py-8 max-w-screen-sm">
        <h2 class="mb-1 text-3xl tracking-tight font-bold text-gray-900">{{ $post['title'] }}</h2>
        <div>
            By
            <a href="/authors/{{ $post->author->username }}" class="hover:underline">{{ $post->author->name }}</a> in
            <a href="/categories/{{ $post->category->slug }}"
                class="hover:underline tect-base text-gray-500">{{ $post->category->name }}</a>
            <p class="my-4 font-light">{{ $post['body'], 50 }}
            </p>
            <a href="/posts" class="font-medium text-blue-500 hover:underline">&laquo; Back to posts</a>
    </article>

</x-layout>
