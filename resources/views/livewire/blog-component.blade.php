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

                    <div class="col-md-3" wire:ignore>
                        <div class="mb-4">
                            <strong>Filter by Tags:</strong>
                            <select multiple wire:model="selectedOptionsTags" class="tagFilter form-control">
                                @foreach($tags as $tag)
                                    <option wire:key="{{$tag->id}}" value="{{ $tag->id }}">{{ $tag->name }}</option>
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
                            <a class="btn btn-sm btn-success mb-2" href="{{route('posts.category', $post->category)}}">
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.tagFilter').select2({
            placeholder: 'Select Tags',
            theme: 'classic',
            allowClear: true,
        });
    });


</script>

<script>


    $(".tagFilter").change(function () {
        window.livewire.emit('setTagData', $(this).val());
    });


</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"/>
