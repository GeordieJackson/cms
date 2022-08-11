<?php

    namespace App\Http\Controllers\Frontend;

    use App\Http\Controllers\Controller;
    use App\Models\Posts\Post;
    use App\Models\Users\User;
    use App\Presenters\Authors\AuthorPresenter;
    use App\Presenters\Authors\AuthorsPresenter;
    use App\Repositories\Author\AuthorRepository;

    use function abort_unless;
    use function dump;

    class AuthorController extends Controller
    {
        public function index()
        {
            $authors = User::publishedAuthors();
            abort_unless($authors->count(), 404);
            return new AuthorsPresenter($authors);
        }

        public function show($slug)
        {
            return new AuthorPresenter(User::publishedAuthorBySlug($slug));
        }
    }
