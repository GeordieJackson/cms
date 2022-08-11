<?php
    
    namespace App\Models\Categories;
    
    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    
    use function collect;
    use function str_replace;
    
    class Category extends Model
    {
        use HasFactory, CategoryScopes;
        
        protected $fillable = ['category_id', 'slug', 'name', 'count'];
        
        public function __construct(array $attributes = [])
        {
            parent::__construct($attributes);
            $this->timestamps = false;
        }
        
        /**
         * @param array $models
         * @return \App\Models\Categories\CategoryCollection|\Illuminate\Database\Eloquent\Collection
         */
        public function newCollection(array $models = [])
        {
            return new CategoryCollection($models);
        }
        
        public function children()
        {
            return $this->hasMany(Category::class)->orderBy('name');
        }
        
        public function descendants()
        {
            return $this->hasMany(Category::class)->orderBy('name')
                ->with('descendants');
        }
        
        public function parent()
        {
            return $this->belongsTo(Category::class, 'category_id', 'id');
        }
        
        public function parents()
        {
            return $this->belongsTo(Category::class, 'category_id', 'id')
                ->with('parents');
        }
        
        public function getDisplayNameAttribute()
        {
            return ucfirst(str_replace("-", " ", $this->attributes['name']));
        }
        
        /**
         *  Return a collection of category ID + categories' IDs for a given category
         *
         * @return \Illuminate\Support\Collection
         */
        public function getIdList($reset = 1)
        {
            static $ids;
            if ($reset) {
                $ids = [];
            }
            
            $ids [] = $this->id;
            $this->descendants->each(fn($row) => $row->getIdList($reset = 0));
            
            return collect($ids)
                ->unique()
                ->sort();
        }
        
        public function getAncestors()
        {
            $ancestors = collect();
            $currentCategory = $this;
            
            do {
                $ancestors [] = ['name' => $currentCategory->name, 'slug' => $currentCategory->slug];
            } while ($currentCategory = $currentCategory->parents);
            
            return $ancestors->reverse();
        }
    }
