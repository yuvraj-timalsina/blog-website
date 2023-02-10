@extends('layouts.blog')
@section('header')
    Category :  <span class="text-secondary">{{$category->name}}</span>
@endsection
@section('content')
    <div>
        <div class="container">
            <!-- Blog entries-->
            <div class="row justify-content-center">
                <!-- Nested row for blogs-->
                @forelse($posts as $post)
                    <div class="col-lg-3 col-md-4 col-sm-12">
                        <!-- Blog post-->
                        <div class="card mb-4">
                            <a href="{{route('posts.show', $post)}}">
                                <img class="card-img-top"
                                     src="{{asset('/storage/' . $post->image?->imageFile)}}"
                                     alt="{{$post->title}}"/></a>
                            <div class="card-body">
                                <a class="btn btn-sm btn-success mb-2"
                                   href="{{route('posts.category', $post->category)}}">
                                    {{$post->category->name}}
                                </a>
                                <h2 class="card-title h4">
                                    {{ $post->title }}
                                </h2>
                                <p class="card-text">
                                    {!! Str::words(strip_tags($post->content), 10) !!}
                                </p>
                                <div onclick="window.location='{{ route('posts.user', $post->user) }}'"
                                     class="d-flex flex-row align-items-center" style="cursor: pointer">
                                    <div class="icon"><i class='bx bxs-user-circle'></i></div>
                                    <div class="ms-1 c-details">
                                        <h6 class="mb-0">{{$post->user->name}}</h6>
                                        <span>{{$post->created_at->format('M d, Y')}}</span>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    @foreach($post->tags as $tag)
                                        <a class="btn btn-sm btn-outline-danger" href="{{route('posts.tag', $tag)}}">
                                            {{$tag->name}}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <h3 class="text-center mb-5">Nothing to Display!</h3>
                @endforelse
                <!-- Pagination-->
                {{ $posts->links()}}
            </div>
        </div>
    </div>
    </div>

@endsection
