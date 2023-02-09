<?php

    namespace App\Models;

    use Cviebrock\EloquentSluggable\Sluggable;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Category extends Model
    {
        use HasFactory;
        use SoftDeletes;
        use Sluggable;

        protected $fillable = ['name', 'slug'];

        public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
        public function getRouteKeyName() : string
        {
            return 'slug';
        }

        public function posts() : HasMany
        {
            return $this->hasMany(Post::class);
        }
    }
