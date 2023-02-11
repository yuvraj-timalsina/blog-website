<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\Post\StorePostRequest;
    use App\Http\Requests\Post\UpdatePostRequest;
    use App\Imports\PostImport;
    use App\Models\Post;
    use App\Models\Tag;
    use App\Traits\FetchCategory;
    use App\Traits\FetchTag;
    use Illuminate\Http\Request;
    use Illuminate\Http\Response;
    use Maatwebsite\Excel\Facades\Excel;

    class PostController extends Controller
    {
        use FetchCategory;
        use FetchTag;

        /**
         * Apply categories count middleware.
         *
         * @return Response
         */
        public function __construct()
        {
            $this->middleware('VerifyCategoriesCount')->only(['create', 'store']);
        }

        /**
         * Display a listing of the resource.
         *
         * @return Response
         */
        public function index()
        {
            return view('posts.index');
        }

        /**
         * Display the specified resource.
         *
         * @param \App\Models\Post $post
         *
         * @return \Illuminate\Http\Response
         */
        public function show(Post $post)
        {
            return view('posts.single', compact('post'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param Request $request
         * @param Post $post
         *
         * @return Response
         */
        public function update(UpdatePostRequest $request, Post $post)
        {
            $data = $request->safe()->except(['thumbnail']);
            /** check if post has image */
            if ($request->hasFile('thumbnail')) {
                /** upload new image */
                $image = $request->thumbnail->store('posts');
                /** delete old image */
                $post->deleteImage();
                $data['thumbnail'] = $image;
            }

            $post->update($data);

            $attachableTags = [];
            foreach ($request->tags as $tag) {
                $attachableTags[] = Tag::firstOrCreate([
                    'name' => $tag,
                ])->id;
            }
            $post->tags()->sync($attachableTags);
            /** redirect user to index page */
            flash('Post Updated Successfully!');

            return to_route('posts.index');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param Request $request
         *
         * @return Response
         */
        public function store(StorePostRequest $request)
        {
            $post = Post::create($request->safe()->except(['thumbnail']) + ['user_id' => auth()->id()]);

            if ($request->hasFile('thumbnail')) {
                $image = $request->thumbnail->store('posts');
                $post->image()->create([
                    'imageFile' => $image
                ]);
            }

            $attachableTags = [];
            foreach ($request->tags as $tag) {
                $attachableTags[] = Tag::firstOrCreate([
                    'name' => $tag,
                ])->id;
            }
            $post->tags()->sync($attachableTags);

            flash('Post Created Successfully!');

            return to_route('posts.index');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return Response
         */
        public function create()
        {
            $categories = $this->fetchCategory();
            $tags = $this->fetchTag();

            return view('posts.create', compact('categories', 'tags'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param Post $post
         *
         * @return Response
         */
        public function edit(Post $post)
        {
            $categories = $this->fetchCategory();
            $tags = $this->fetchTag();

            return view('posts.edit', compact('post', 'categories', 'tags'));
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param Post $post
         *
         * @return Response
         */
        public function destroy(Post $post)
        {
            $post->delete();
            flash('Post Deleted Successfully!');

            return to_route('posts.index');
        }

        public function postImport(Request $request)
        {
            Excel::import(new PostImport, $request->file('file')->store('temp'));
            flash('Posts Imported Successfully!');

            return back();
        }
    }
