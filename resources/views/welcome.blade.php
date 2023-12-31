<x-layout>

    @include ('_post-header')
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if ($posts->count())
            <x-posts-grid :posts="$posts"/>
            {{$posts->links()}}
        @else
            <p>No posts yet, Please check back later</p>
        @endif
    </main>
    {{--@foreach ($posts as $post)--}}
    {{--    <article>--}}
    {{--         <h1><a href="/posts/{{$post->id}}"> {!!$post->title  !!} </a></h1>--}}
    {{--        <h4>By <a href="/authors/{{$post->author->username }}">{{$post->author->name }}</a> in <a href="categories/{{$post->category->slug}}"> {{$post->category->name}} </a></h4>--}}
    {{--        <p>{{ $post->excerpt}} </p>--}}
    {{--        </article>--}}
    {{-- @endforeach--}}

    {{--  <script src="index.js"></script>--}}

</x-layout>
