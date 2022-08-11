<?php

    namespace App\Models\Categories;

    trait CategoryScopes
    {
        public function scopeOrderedByLevel($query)
        {
            return $query->where('category_id', 0)->with('descendants')->get()->topLevel();
        }

        public function scopeWithChildIds($query)
        {
            return $query->select('id', 'category_id', 'slug', 'name')->with(['descendants' => function($query) {
                $query->select('id', 'category_id', 'slug', 'name');
            }])->orderBy('name');
        }

        public function scopeActiveCategories($query)
        {
            return $query->where('count', '>', 0)->orderBy('name')->get();
        }
    
        /**
         *  Promote subcategories to the category's parent
         *  Delete the category
         */
        public function scopeSafeDelete($query, $category)
        {
            $this->where('category_id', $category->id)->update(['category_id' => $category->category_id]);
            $category->delete();
        }
    }
