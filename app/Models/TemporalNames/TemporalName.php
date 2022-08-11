<?php
    
    namespace App\Models\TemporalNames;
    
    use App\Models\Posts\Post;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    use function ucfirst;
    
    class TemporalName extends Model
    {
        use HasFactory, SoftDeletes;
        
        protected $fillable = ['name', 'slug', 'active'];
    
        public function posts()
        {
            return $this->belongsTo(Post::class, 'id', 'temporal_id');
        }
        
        public function scopeActiveTemporalNames()
        {
            return $this::select('temporal_names.slug', 'temporal_names.name')
                ->whereActive(1)
                ->join('posts',
                    function ($join) {
                        $join->on('temporal_names.id', "=", 'temporal_id')
                            ->where('type', Post::TEMPORAL)
                            ->where('temporal_id', ">", 0)
                            ->where('published', 1)
                            ->where('publication_date', "<=", Carbon::now())
                            ->where('posts.deleted_at', null);
                    })
                ->distinct()
                ->orderBy('name')
            ;
        }
    }
