<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\Category\StoreCategoryRequest;
    use App\Http\Requests\Category\UpdateCategoryRequest;
    use App\Models\Category;

    class CategoryController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {

            return view('categories.index');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         *
         * @return \Illuminate\Http\Response
         */
        public function store(StoreCategoryRequest $request)
        {
            Category::create($request->validated());
            flash('Category Created Successfully!');

            return to_route('categories.index');
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('categories.create');
        }

        /**
         * Display the specified resource.
         *
         * @param \App\Models\Category $category
         *
         * @return \Illuminate\Http\Response
         */
        public function show(Category $category)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param \App\Models\Category $category
         *
         * @return \Illuminate\Http\Response
         */
        public function edit(Category $category)
        {
            return view('categories.edit', compact('category'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @param \App\Models\Category $category
         *
         * @return \Illuminate\Http\Response
         */
        public function update(UpdateCategoryRequest $request, Category $category)
        {
            $category->update($request->validated());
            flash('Category Updated Successfully!');

            return to_route('categories.index');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param \App\Models\Category $category
         *
         * @return \Illuminate\Http\Response
         */
        public function destroy(Category $category)
        {
            $category->delete();
            flash('Category Deleted Successfully!');

            return to_route('categories.index');
        }
    }
