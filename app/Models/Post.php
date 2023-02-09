<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Casts\Attribute;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\Relations\MorphOne;
    use Illuminate\Database\Eloquent\SoftDeletes;

    class Post extends Model
    {
        use HasFactory;
        use SoftDeletes;

        protected $fillable = ['title', 'slug', 'content', 'thumbnail', 'category_id', 'user_id'];

        public function getRouteKeyName() : string
        {
            return 'slug';
        }

        public function image() : MorphOne
        {
            return $this->morphOne(Image::class, 'imageable');
        }

        public function user() : BelongsTo
        {
            return $this->belongsTo(User::class);
        }

        public function category() : BelongsTo
        {
            return $this->belongsTo(Category::class);
        }

        public function tags() : BelongsToMany
        {
            return $this->belongsToMany(Tag::class);
        }

        /**
         * Return Tag names in array.
         *
         * @param [type] $name
         *
         * @return boolean
         */
        public function hasTag($name) : bool
        {
            return in_array($name, $this->tags->pluck('name')->toArray(), true);
        }

        /**
         * Concatenate storage with image path.
         *
         * @return \Illuminate\Database\Eloquent\Casts\Attribute
         */
        protected function thumbnail() : Attribute
        {
            return Attribute::make(
                get : static fn($value) => asset('/storage/' . $value)
            );
        }
    }
