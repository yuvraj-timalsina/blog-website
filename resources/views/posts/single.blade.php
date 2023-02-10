@extends('layouts.blog')
@section('header')
    <span class="text-secondary"> {{ $post->title }}</span>
@endsection
@section('content')
    <div>
        <div class="py-5 bg-light border-bottom mb-4 blog-thumbnail"
             style="background-image: url('{{asset('/storage/' . $post->image?->imageFile)}}')">
        </div>
        <hr class="m-0"/>
        <div class="container mt-4">
            <!-- Blog entries-->
            <div class="row justify-content-center">
                <!-- Nested row for blogs-->
                <div class="col-12">
                    <!-- Blog post-->
                    <div class="mb-4">
                        <a class="btn btn-sm btn-success mb-2"
                           href="{{route('posts.category', $post->category)}}">{{$post->category->name}}</a>
                        <p class="card-text">
                            {!! $post->content !!}
                        </p>
                    </div>
                </div>
            </div>
            <!-- Author Meta-->
           <div class="my-5">
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
                    <a class="btn btn-sm btn-outline-danger" href="{{route('posts.tag', $tag)}}">{{$tag->name}}</a>
                @endforeach
            </div>
           </div>
        </div>
    </div>
@endsection
