<?php

    namespace App\Imports;

    use App\Models\Post;
    use Maatwebsite\Excel\Concerns\ToModel;

    class PostImport implements ToModel
    {
        /**
         * @param array $row
         *
         * @return \Illuminate\Database\Eloquent\Model|null
         */
        public function model(array $row)
        {
            return new Post([
                'title' => $row[1],
                'slug' => $row[2],
                'content' => $row[3],
                'user_id' => $row[4],
                'category_id' => $row[5],
                'created_at' => $row[7],
            ]);
        }
    }
