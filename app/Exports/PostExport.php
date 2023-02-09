<?php

    namespace App\Exports;

    use App\Models\Post;
    use Maatwebsite\Excel\Concerns\FromCollection;

    class PostExport implements FromCollection
    {
        public $posts;

        public function __construct($posts)
        {
            $this->posts = $posts;
        }

        public function collection()
        {
            return Post::whereIn('id', $this->posts)->get();
        }
    }
