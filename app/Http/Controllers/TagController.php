<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\Tag\StoreTagRequest;
    use App\Http\Requests\Tag\UpdateTagRequest;
    use App\Models\Tag;

    class TagController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {

            return view('tags.index');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(StoreTagRequest $request)
        {
            Tag::create($request->validated());
            flash('Tag Created Successfully!');

            return to_route('tags.index');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('tags.create');
        }

        /**
         * Display the specified resource.
         *
         * @param \App\Models\Tag $tag
         *
         * @return \Illuminate\Http\Response
         */
        public function show(Tag $tag)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param \App\Models\Tag $tag
         *
         * @return \Illuminate\Http\Response
         */
        public function edit(Tag $tag)
        {
            return view('tags.edit', compact('tag'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param \App\Models\Tag $tag
         *
         * @return \Illuminate\Http\Response
         */
        public function update(UpdateTagRequest $request, Tag $tag)
        {
            $tag->update($request->validated());
            flash('Tag Updated Successfully!');

            return to_route('tags.index');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param \App\Models\Tag $tag
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy(Tag $tag)
        {
            $tag->delete();
            flash('Tag Deleted Successfully!');

            return to_route('tags.index');
        }
    }
