<?php

    namespace App\Models\Categories;

    use Illuminate\Database\Eloquent\Collection;
    use function Tests\Feature\Categories\getChildrenFor;

    class CategoryCollection extends Collection
    {
        public function topLevel()
        {
            return $this->where('category_id', 0);
        }
    }
