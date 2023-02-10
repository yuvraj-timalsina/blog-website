<div>
    <div class="container">
        <form method="GET" action="">
            <div class="col-lg-12">
                <!-- Search widget-->
                <div class="row d-flex justify-content-center">
                    <div class="col-md-9">
                        <div class="mb-4">
                            <strong>Search by Blog Title:</strong>
                            <input wire:model="title" class="form-control" type="text"
                                   placeholder="Search by Blog Title..."/>
                        </div>
                    </div>
                </div>
                <!-- Filter widgets-->
                <div class="row d-flex justify-content-center">
                    <div class="col-md-3">
                        <div class="mb-4">
                            <strong>Filter by Author:</strong>
                            <select wire:model="user" class="form-select" aria-label="Author Filter">
                                <option hidden>Author (0)</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-4">
                            <strong>Filter by Category:</strong>
                            <select wire:model="category" class="form-select" aria-label="Category Filter">
                                <option hidden>Category (0)</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mb-4">
                            <strong>Filter by Tag:</strong>
                            <select wire:model="tag" class="form-select" aria-label="Tag Filter">
                                <option hidden>Tag (2)</option>
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mb-5">
                    <div class="col-9">
                        <a wire:click="resetFilters" href="#">Clear All</a>
                    </div>
                </div>
            </div>
        </form>
        <!-- Blog entries-->
        <div class="row justify-content-center">
            <!-- Nested row for blogs-->
            @forelse($posts as $post)
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <!-- Blog post-->
                    <div class="card mb-4">
                        <a href="{{route('posts.show', $post)}}"><img class="card-img-top"
                                                                      src="{{asset('/storage/' . $post->image?->imageFile)}}"
                                                                      alt="{{$post->title}}"/></a>
                        <div class="card-body">
                            <a class="btn btn-sm btn-success mb-2" href="#!">{{$post->category->name}}</a>
                            <h2 class="card-title h4">
                                {{ $post->title }}
                            </h2>
                            <p class="card-text">
                                {!! Str::words(strip_tags($post->content), 10) !!}
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
            @empty
                <h3 class="text-center mb-5">Nothing to Display!</h3>
            @endforelse
            <!-- Pagination-->
            {{ $posts->links()}}
        </div>
    </div>
</div>
</div>
