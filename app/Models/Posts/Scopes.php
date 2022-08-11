<?php
    
    namespace App\Models\Posts;
    
    use App\Models\TemporalNames\TemporalName;
    use Carbon\Carbon;
    use Illuminate\Database\Eloquent\Builder;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Gate;
    
    trait Scopes
    {
        /**
         *  GLOBAL SCOPES
         */
        protected static function booted()
        {
            parent::booted();
            
            static::addGlobalScope(
                'restricted',
                function (Builder $query) {
                    if (auth()->check() && Gate::denies('manage.posts')) {
                        $query->where('owner_id', Auth::user()->id);
                    }
                }
            );
        }
        
        /**
         * @param  Builder  $query
         * @param $slug
         * @param $type
         * @return mixed
         */
        public function scopeFromSlug(Builder $query, $slug, $type)
        {
            return $query->where('slug', $slug)->where('type', $type)->published();
        }
        
        public function scopeFromId(Builder $query, $id, $type)
        {
            return $query->whereId($id)->where('type', $this->type)->published()->firstOrFail();
        }
        
        public function scopeByAuthorId(Builder $query, $authorId)
        {
            return $query->select('category_id', 'temporal_id', 'title', 'type', 'slug')
                ->where('owner_id', $authorId)
                ->where('type', "!=", Post::PAGE)
                ->published()
                //  ->orderBy('type')
                ->orderBy('title');
        }
        
        public function scopeAllCategorized($query)
        {
            return $this->whereType(static::CATEGORIZED)->published();
        }
        
        public function scopeAllTemporal($query, $slug)
        {
            // This ensures that empty blog categories return zero results but single-slug matches throw a 404
            $check = TemporalName::where('slug', $slug)->first();
            abort_if(is_null($check) || $check->active == 0, 404);
            
            return $this->withoutGlobalScope('restricted')->where('type', static::TEMPORAL)->published()->whereHas(
                'temporal',
                function ($query) use ($slug) {
                    $query->where('slug', $slug);
                }
            )->orderBy('sticky', 'desc')->orderBy('publication_date', 'desc')->get();
        }
        
        /**
         *  Set $ignorePublishedAt to true to get all published regardless of publication_date date
         *
         * @param      $query
         * @param  bool  $ignorePublishedAt
         * @return mixed
         */
        public function scopePublished($query, $ignorePublishedAt = false)
        {
            return $query->where('published', 1)->where('publication_date', "<=", Carbon::now());
        }
        
        /**
         *  Get all posts for a given category
         *
         * @param $query
         * @param $categoryName
         * @return mixed
         */
        public function scopeCategoryList($query, $categoryName)
        {
            return $query->whereHas(
                'category',
                function (Builder $query) use ($categoryName) {
                    $query->where('slug', $categoryName);
                }
            )->whereType(Post::CATEGORIZED)->published();
        }
        
        public function scopeActivePages()
        {
            return Post::select('slug', 'title')
                ->where('slug', '!=', Post::HOMEPAGE)
                ->whereType(Post::PAGE)
                ->published();
        }
        
        
        
        
        /**
         *  FRONTEND SCOPES
         */
        
        /**
         *  This one only allows posts whose temporal name section is active to be returned
         */
        public function scopeFiltered($query)
        {
            return $query->whereType(Post::CATEGORIZED)
                ->orWhere(function ($q) {
                    $q->where('type', Post::TEMPORAL)
                        ->whereIn('temporal_id', TemporalName::where('active', "=", 1)
                            ->get('id')
                            ->toArray());
                });
        }
        
        public function scopeBySlug($query, $slug)
        {
            return $query->withoutGlobalScope('restricted')
                ->with('category.parents') // for breadcrumb generation
                ->whereSlug($slug);
        }
        
        public function scopePostsInCategory($query, $category)
        {
            return $query->withoutGlobalScope('restricted')->with('category.parents')->categoryList($category)->orderBy('title');
        }
        
        public function scopeAllTemporalFront($query, $temporalName)
        {
            return $query->withoutGlobalScope('restricted')
                ->select('title', 'summary', 'owner_id', 'publication_date', 'image', 'slug', 'temporal_id')
                ->with('owner')
                ->where('type', static::TEMPORAL)
                ->published()
                ->whereHas('temporal', function ($query) use ($temporalName) {
                    $query->where('slug', $temporalName);
                })
                ->orderBy('sticky', 'desc')
                ->latest('publication_date');
        }
        
        public function scopeBlogEntry($query, $temporalName, $slug)
        {
            return $query->withoutGlobalScope('restricted')->with('tags')->whereHas(
                'temporal',
                function ($query) use ($temporalName) { // Post can only be displayed in its own temporal name
                    $query->whereSlug($temporalName);
                }
            )->fromSlug($slug, Post::TEMPORAL);
        }
    }
