<?php

    namespace App\Observers;

    use Facades\App\Services\Flash;
    use App\Models\Categories\Category;

    class CategoryObserver
    {
        /**
         * Handle the category "created" event.
         *
         * @param \App\Category $category
         * @return void
         */
        public function created(Category $category)
        {
            Flash::success('Your category was created.');
        }

        /**
         * Handle the category "updated" event.
         *
         * @param \App\Category $category
         * @return void
         */
        public function updated(Category $category)
        {
            Flash::success('Your category was updated.');
        }

        /**
         * Handle the category "deleted" event.
         *
         * @param \App\Category $category
         * @return void
         */
        public function deleted(Category $category)
        {
            Flash::success('Your category was deleted.');
        }

        /**
         * Handle the category "restored" event.
         *
         * @param \App\Category $category
         * @return void
         */
        public function restored(Category $category)
        {
            //
        }

        /**
         * Handle the category "force deleted" event.
         *
         * @param \App\Category $category
         * @return void
         */
        public function forceDeleted(Category $category)
        {
            //
        }
    }
