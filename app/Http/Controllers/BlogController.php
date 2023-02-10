<?php

    namespace App\Http\Controllers;

    use App\Models\Category;
    use App\Models\Tag;
    use App\Models\User;
    use Illuminate\Http\Request;

    class BlogController extends Controller
    {
        public function categoryPosts(Request $request, Category $category)
        {
            return view('posts.category', [
                $this->fetchData(),
                'category' => $category,
                'posts' => $category->posts()->with(['user', 'category', 'tags'])->paginate(8),
            ]);
        }

        private function fetchData() : array
        {
            return [
                'users' => User::all(),
                'categories' => Category::all(),
                'tags' => Tag::all()
            ];
        }

        public function tagPosts(Request $request, Tag $tag)
        {
            return view('posts.tag', [
                $this->fetchData(),
                'tag' => $tag,
                'posts' => $tag->posts()->with(['user', 'category', 'tags'])->paginate(8),
            ]);
        }

        public function userPosts(Request $request, User $user)
        {
            return view('posts.user', [
                $this->fetchData(),
                'user' => $user,
                'posts' => $user->posts()->with(['category', 'tags'])->paginate(8),
            ]);
        }
    }
