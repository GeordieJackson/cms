<?php

    namespace App\Models\Posts;

    use App\Models\Categories\Category;
    use App\Models\TemporalNames\TemporalName;
    use App\Models\Users\User;
    use App\Models\Tags\Tag;

    trait Relationships
    {
        public function owner()
        {
            return $this->belongsTo(User::class, 'owner_id', 'id');
        }

        public function temporal()
        {
            return $this->hasOne(TemporalName::class, 'id', 'temporal_id');
        }

        public function category()
        {
            return $this->hasOne(Category::class, 'id', 'category_id');
        }

        public function tags()
        {
            return $this->belongsToMany(Tag::class, 'post_tag');
        }
    }
