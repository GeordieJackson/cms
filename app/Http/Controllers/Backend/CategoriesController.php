<?php

    namespace App\Http\Controllers\Backend;

    use Facades\App\Services\Flash;
    use App\Models\Categories\Category;
    use App\Http\Controllers\Controller;
    use Facades\App\Services\MenuBuilder;
    use App\Http\Requests\CategoryFormRequest;

    use function dump;
    use function redirect;

    class CategoriesController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $categories = Category::withChildIds()->get();
            $categoryTree = MenuBuilder::makeBackendMenuFrom(Category::orderedByLevel());

            return view('dashboard.categories.index')->with([
                'categories' => $categories,
                'categoryTree' => $categoryTree,
            ]);
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(CategoryFormRequest $request)
        {
            Category::create($request->validated());

            return redirect()->action([CategoriesController::class, 'index']);
        }

        /**
         * @param  \App\Http\Requests\CategoryFormRequest  $request
         * @param  \App\Models\Categories\Category  $category
         * @return \Illuminate\Http\RedirectResponse
         */
        public function update(CategoryFormRequest $request, Category $category)
        {
            $category->update($request->validated());

            return redirect()->action([CategoriesController::class, 'index']);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param int $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Category $category)
        {
            if($category->count) {
                Flash::warning($category->displayName . " cannot be deleted - it contains posts.");
            } else {
                Category::safeDelete($category);
            }

            return redirect()->action([CategoriesController::class, 'index']);
        }
    }
