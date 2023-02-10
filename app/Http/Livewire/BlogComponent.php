<?php

    namespace App\Http\Livewire;

    use App\Models\Category;
    use App\Models\Post;
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
        public $tags = [];
        public $users = [];
        public $categories = [];
        public $selectedOptionsTags = [];
        protected $paginationTheme = 'bootstrap';
        protected $listeners = ['setTagData'];

        public function setTagData($tag)
        {
            $this->selectedOptionsTags = $tag;
        }

        public function updated() : void
        {
            $this->resetPage();
        }

        public function mount()
        {
            $this->categories = Category::all();
            $this->tags = Tag::all();
            $this->users = User::all();
        }

        public function resetFilters() : void
        {
            $this->reset(['user', 'title', 'category', 'selectedOptionsTags']);
        }

        public function render()
        {
            $posts = Post::with(['user', 'category', 'tags']);

            if (!empty($this->title)) {
                $posts->where('title', 'LIKE', '%' . $this->title . '%');
            }
            if (!empty($this->category)) {
                $posts->where('category_id', $this->category);
            }
            if (count($this->selectedOptionsTags)) {
                $posts->whereHas('tags', function ($query) {
                    $query->whereIn('tags.id', $this->selectedOptionsTags);
                });
            }
            if (!empty($this->user)) {
                $posts->where('user_id', $this->user);
            }

            $posts = $posts->paginate(8);

            return view('livewire.blog-component',
                [
                    'posts' => $posts,
                ]);
        }
    }
