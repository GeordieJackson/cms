<?php

    use App\Http\Controllers\Backend\Acl\AssignmentsController;
    use App\Http\Controllers\Backend\Acl\PermissionsController;
    use App\Http\Controllers\Backend\Acl\RolesController;
    use App\Http\Controllers\Backend\CategoriesController;
    use App\Http\Controllers\Backend\DashboardController;
    use App\Http\Controllers\Backend\Files\FileUploadController;
    use App\Http\Controllers\Backend\Images\ImageUploadController;
    use App\Http\Controllers\Backend\Posts\PostsController;
    use App\Http\Controllers\Backend\Stats\VisitorStatsController;
    use App\Http\Controllers\Backend\Tags\TagController;
    use App\Http\Controllers\Backend\TemporalNameController;
    use App\Http\Controllers\Backend\Users\UserController;
    use App\Http\Controllers\Frontend\AuthorController;
    use App\Http\Controllers\Frontend\HomeController;
    use App\Http\Controllers\Frontend\SearchController;
    use App\Http\Controllers\Frontend\TemporalController;
    use App\Http\Controllers\Frontend\CategoriesController as FrontCategoriesController;
    use App\Http\Controllers\RouteStrategyController;
    use Illuminate\Support\Facades\Route;

    /*
    |--------------------------------------------------------------------------
    | Web Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register web routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | contains the "web" middleware group. Now create something great!
    |
    */

    Route::get('/', HomeController::class)->name('home')->middleware('visitor.tracker');

    // Authors
    Route::name('authors.')->prefix('authors')->group(function () {
        Route::get('/', [AuthorController::class, 'index'])->name('index')->middleware('visitor.tracker');
        Route::get('{author}', [AuthorController::class, 'show'])->name('show')->middleware('visitor.tracker');
    });

    // Tags
    Route::name('tags.')->prefix('tags')->group(function () {
        Route::get('/', [TagController::class, 'index'])->name('index')->middleware('visitor.tracker');
        Route::get('{tag}', [TagController::class, 'show'])->name('show')->middleware('visitor.tracker');
    });

    // Categories
    Route::name('categories.')->prefix('categories')->group(function () {
        Route::get('/', [FrontCategoriesController::class, 'index'])->name('index')->middleware('visitor.tracker');
        Route::get('{category}', [FrontCategoriesController::class, 'show'])->name('show')->middleware('visitor.tracker');
    });
    
    Route::match(['get', 'post'], 'search', [SearchController::class, 'index'])->name('search')->middleware('visitor.tracker');

    // Dashboard
    Route::name('dashboard.')->prefix('dashboard')->middleware(['auth:sanctum', 'verified', 'can:see.dashboard'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('home');

        //ACL
        Route::middleware('can:manage.acl')->group(function () {
            Route::resource('roles', RolesController::class);
            Route::resource('permissions', PermissionsController::class);
            Route::get('assign', [AssignmentsController::class, 'index'])->name('assign.index');
            Route::get('assign/{role_id}', [AssignmentsController::class, 'show'])->name('assign.show');
            Route::post('assign', [AssignmentsController::class, 'setRole'])->name('assign.setRole');
            Route::put('assign/update/{role_id}', [AssignmentsController::class, 'update'])->name('assign.update');
        });
        
        // Images
        Route::get('images/uploader', [ImageUploadController::class, 'index'])->name('image_uploader');

        // Categories
        Route::resource('categories', CategoriesController::class)->middleware('can:manage.categories');

        // Content
        Route::resource('posts', PostsController::class);
        Route::resource('users', UserController::class)->middleware('restricted.user');
        
        // Temporal section names
        Route::resource('temporalNames', TemporalNameController::class)->middleware('restricted.user');
        
        // Visitor stats
        Route::get('stats', [VisitorStatsController::class, 'index'])->name('stats.index')->middleware('can:see.stats');
        Route::delete('stats/{group}/{id}', [VisitorStatsController::class, 'delete'])->name('stats.delete')->middleware('can:see.stats');
    });

    Route::get('{temporalName}/{slug}', [TemporalController::class, 'show'])->name('temporal.show')->middleware('visitor.tracker');
    //
    Route::get('{slug}', RouteStrategyController::class)->name('post')->middleware('visitor.tracker');
