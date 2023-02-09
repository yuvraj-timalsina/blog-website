<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Tag extends Model
    {
        use HasFactory;
        use SoftDeletes;

        protected $fillable = ['name', 'slug'];

        public function getRouteKeyName() : string
        {
            return 'slug';
        }

        public function posts() : BelongsToMany
        {
            return $this->belongsToMany(Post::class);
        }
    }
