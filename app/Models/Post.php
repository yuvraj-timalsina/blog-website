<?php

    namespace App\Models;

    use Cviebrock\EloquentSluggable\Sluggable;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\BelongsToMany;
    use Illuminate\Database\Eloquent\Relations\MorphOne;
    use Illuminate\Database\Eloquent\SoftDeletes;
    use Illuminate\Support\Facades\Storage;

    class Post extends Model
    {
        use HasFactory;
        use SoftDeletes;
        use Sluggable;

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
         * Delete post image from Storage.
         *
         * @return void
         */
        public function deleteImage() : void
        {
            if ($this->image) {
                Storage::delete($this->image->imageFile);
            }
        }

        public function sluggable() : array
        {
            return [
                'slug' => [
                    'source' => 'title'
                ]
            ];
        }
    }
