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
                'id' => $row[0],
                'title' => $row[1],
                'slug' => $row[2],
                'content' => $row[3],
                'user_id' => $row[4],
                'category_id' => $row[5],
                'deleted_at' => $row[6],
                'created_at' => $row[7],
                'updated_at' => $row[8],
            ]);
        }
    }
