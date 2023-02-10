<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content="Yv"/>
    <title> {{ config('app.name', 'Blog Website')}} </title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{ asset('blog/css/styles.css') }}" rel="stylesheet"/>
    <!-- Boxicons CDN-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css"/>
</head>
<body>
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4 blog-thumbnail"
style="background-image: url('{{asset('/storage/' . $post->image?->imageFile)}}')">
</header>
<!-- Page content-->
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">
                {{ $post->title }}
            </h1>
            <hr class="my-5"/>
    </div>
        <!-- Blog entries-->
        <div class="row justify-content-center">
            <!-- Nested row for blogs-->
                <div class="col-12">
                    <!-- Blog post-->
                    <div class="mb-4">
                            <a class="btn btn-sm btn-success mb-2" href="#!">{{$post->category->name}}</a>
                            <p class="card-text">
                                {!! $post->content !!}
                            </p>
                            <div class="d-flex flex-row align-items-center">
                                <div class="icon"><i class='bx bxs-user-circle'></i></div>
                                <div class="ms-1 c-details">
                                    <h6 class="mb-0">{{$post->user->name}}</h6>
                                    <span>{{$post->created_at->format('M d, Y')}}</span>
                                </div>
                            </div>
                            <div class="mt-2">
                                @foreach($post->tags as $tag)
                                    <a class="btn btn-sm btn-outline-danger" href="#!">{{$tag->name}}</a>
                                @endforeach
                            </div>
                        </div>
                </div>
        </div>
    </div>
</div>

<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container"><p class="m-0 text-center text-white">Copyright
            &copy; {{ config('app.name', 'Blog Website')}} {{date('Y')}}</p></div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Core theme JS-->
<script src="{{ asset('blog/js/scripts.js') }}"></script>
</body>
</html>
