<?php
    
    namespace App\Models\Posts;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\SoftDeletes;
    
    class Post extends Model
    {
        use HasFactory, Relationships, Scopes, SoftDeletes;
        
        // Page types
        const TEMPORAL = 1;
        const CATEGORIZED = 2;
        const PAGE = 3;
        public static $types = [
            'temporal' => self::TEMPORAL,
            'categorized' => self::CATEGORIZED,
            'page' => self::PAGE,
        ];
    
        /**
         * @NOTE: The site is designed to work with 'index' as homepage
         */
        const HOMEPAGE = 'index';
        
        protected $dates = ['publication_date'];
        
        protected $with = ['temporal', 'owner', 'category', 'tags'];
        
        protected $fillable = [
            'owner_id',
            'category_id',
            'temporal_id',
            'type',
            'slug',
            'meta_title',
            'meta_description',
            'meta_keywords',
            'title',
            'subtitle',
            'summary',
            'body',
            'pdf',
            'published',
            'publication_date',
            'sticky',
            'image',
            'created_at',
            'updated_at',
            'deleted_at',
        ];
        
        /**
         * @return mixed
         */
        public function getTypeNameAttribute()
        {
            return collect(static::$types)->flip()->get($this->type);
        }
    }
