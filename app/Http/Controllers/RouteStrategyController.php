<?php

    namespace App\Http\Controllers;

    use App\Models\Posts\Post;
    use App\Presenters\Posts\CategorizedPresenter;
    use App\Presenters\Posts\NullPostPresenter;
    use App\Presenters\Posts\StaticPresenter;
    use App\Presenters\Posts\TemporalIndexPresenter;
    use Carbon\Carbon;
    use Facades\App\Http\Controllers\Frontend\TemporalController;

    use function abort_unless;
    use function dd;

    class RouteStrategyController extends Controller
    {
        protected $presenterMap = [
            0 => NullPostPresenter::class,
            2 => CategorizedPresenter::class,
            3 => StaticPresenter::class,
        ];

        /**
         * Handle the incoming request.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function __invoke($slug)
        {
            if ( ! $post = Post::bySlug($slug)->first()) {
                return TemporalController::index($slug);
            }

            abort_unless($presenter = $this->getPresenterFor($post), 404);

            return new $presenter($post);
        }

        /**
         * @param $post
         * @return mixed
         */
        protected function getPresenterFor($post)
        {
            return collect($this->presenterMap)->get($this->getIndexFrom($post));
        }

        /**
         * @param $post
         * @return |null
         */
        protected function getIndexFrom($post)
        {
            return $post->published && $post->publication_date <= Carbon::now() ? $post->type : 0;
        }
    }
