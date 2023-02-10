<?php

    namespace App\Http\Livewire;

    use App\Models\Post;
    use App\Models\Category;
    use App\Models\Tag;
    use App\Models\User;
    use Livewire\Component;
    use Livewire\WithPagination;

    class BlogComponent extends Component
    {
        use WithPagination;

        public $tag;
        public $user;
        public $title;
        public $category;
        protected $paginationTheme = 'bootstrap';

        public function updated() : void
        {
            $this->resetPage();
        }

        public function resetFilters() : void
        {
            $this->reset();
        }

        public function render()
        {
            $posts = Post::with(['user', 'category', 'tags']);

            if (!empty($this->title)) {
                $posts->orWhere('title', $this->title);
            }
            if (!empty($this->category)) {
                $posts->orWhere('category_id', $this->category);
            }
            if (!empty($this->tag)) {
                $posts->orWhereHas('tags', function ($query) {
                    $query->where('tag_id', $this->tag);
                });
            }
            if (!empty($this->user)) {
                $posts->orWhere('user_id', $this->user);
            }

            $posts = $posts->paginate(8);
            $categories = Category::all();
            $tags = Tag::all();
            $users = User::all();

            return view('livewire.blog-component',
                [
                    'posts' => $posts,
                    'categories' => $categories,
                    'tags' => $tags,
                    'users' => $users
                ]);
        }
    }
