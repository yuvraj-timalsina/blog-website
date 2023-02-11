<?php

    namespace App\Exports;

    use App\Models\Post;
    use Maatwebsite\Excel\Concerns\FromCollection;
    use Maatwebsite\Excel\Concerns\WithHeadings;

    class PostExport implements FromCollection, WithHeadings
    {
        public $posts;

        public function __construct($posts)
        {
            $this->posts = $posts;
        }

        public function headings() : array
        {
            return [
                'ID',
                'Title',
                'Slug',
                'Content',
                'Author',
                'Category',
                'Deleted At',
                'Created At',
                'Updated At',
            ];
        }

        public function collection()
        {
            return Post::whereIn('id', $this->posts)->get();
        }
    }
