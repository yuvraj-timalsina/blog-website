<?php

    namespace App\Imports;

    use App\Models\Post;
    use Illuminate\Support\Collection;
    use Maatwebsite\Excel\Concerns\ToCollection;

    class PostImport implements ToCollection
    {
        /**
         * @param \Illuminate\Support\Collection $rows
         *
         * @return void
         */
        public function collection(Collection $rows)
        {
//            foreach ($rows as $row) {
//                Post::create([
//                    'title' => $row[0],
//                    'slug' => $row[1],
//                    'content' => $row[2],
//                    'user_id' => $row[3],
//                    'category_id' => $row[4],
//                    'deleted_at' => $row[5],
//                    'created_at' => $row[6],
//                    'updated_at' => $row[7],
//                ]);
//            }
        }
    }
