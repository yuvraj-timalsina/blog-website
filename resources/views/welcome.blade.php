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
    <!-- Font Awesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
</head>
<body>
<!-- Page header with logo and tagline-->
<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5">
            <h1 class="fw-bolder">Welcome to Blog Website!</h1>
        </div>
    </div>
</header>
<!-- Page content-->
<div class="container">
    <div class="col-lg-12">
        <!-- Search widget-->
        <div class="row d-flex justify-content-center">
            <div class="col-md-9">
                <div class="mb-4">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search by Blog Title..."
                               aria-label="Search by Blog Title..." aria-describedby="button-search"/>
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Filter widgets-->
        <div class="row d-flex justify-content-center">
            <div class="col-md-3">
                <div class="mb-4">
                    <select class="form-select" aria-label="Author Filter">
                        <option hidden="">Author (0)</option>
                        <option value="1">One</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-4">
                    <select class="form-select" aria-label="Category Filter">
                        <option hidden>Category (0)</option>
                        <option value="1">One</option>
                    </select>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mb-4">
                    <select class="form-select" aria-label="Tag Filter">
                        <option hidden>Tag (2)</option>
                        <option value="1">One</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center mb-5">
            <div class="col-9">
                <a href="#">Clear All</a>
            </div>
        </div>
        <!-- Blog entries-->
        <div class="row">
            <!-- Nested row for non-featured blog posts-->
            <div class="col-lg-3 col-md-4 col-sm-12">
                <!-- Blog post-->
                <div class="card mb-4">
                    <a href="#!"><img class="card-img-top" src="https://dummyimage.com/700x350/dee2e6/6c757d.jpg"
                                      alt="..."/></a>
                    <div class="card-body">
                        <div class="small text-muted">January 1, 2022</div>
                        <h2 class="card-title h4">Post Title</h2>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis
                            aliquid atque, nulla.</p>
                        <a class="btn btn-primary" href="#!">Read more →</a>
                    </div>
                </div>
            </div>
            <!-- Pagination-->
            <nav aria-label="Pagination">
                <hr class="my-0"/>
                <ul class="pagination justify-content-center my-4">
                    <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Newer</a>
                    </li>
                    <li class="page-item active" aria-current="page"><a class="page-link" href="#!">1</a></li>
                    <li class="page-item"><a class="page-link" href="#!">2</a></li>
                    <li class="page-item"><a class="page-link" href="#!">3</a></li>
                    <li class="page-item disabled"><a class="page-link" href="#!">...</a></li>
                    <li class="page-item"><a class="page-link" href="#!">15</a></li>
                    <li class="page-item"><a class="page-link" href="#!">Older</a></li>
                </ul>
            </nav>
        </div>
        <!-- Side widgets-->
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
