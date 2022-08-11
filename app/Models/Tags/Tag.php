<?php

    namespace App\Models\Tags;

    use App\Models\Posts\Post;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    use function str_replace;
    use function ucfirst;

    class Tag extends Model
    {
        use HasFactory;

        protected $fillable = ['name', 'slug'];

        public function posts()
        {
            return $this->belongsToMany(Post::class, 'post_tag');
        }
    
        public function activeTags()
        {
            return $this->whereIn('id', function ($query) {
                $query->select('tag_id')->from('post_tag')->distinct();
            })->orderBy('name')->get();
        }
    }
