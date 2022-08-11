<?php

    namespace App\Presenters\Dashboard\Posts;

    use App\Models\Posts\Post;
    use App\Models\Users\User;
    use App\Models\Categories\Category;
    use Illuminate\Support\Facades\Gate;
    use App\Models\TemporalNames\TemporalName;
    use Illuminate\Contracts\Support\Responsable;

    use function auth;

    abstract class BasePostPresenter implements Responsable
    {
        protected $post;
        protected $authors;

        public function __construct(Post $post)
        {
            $this->post = $post;
            $this->authors = Gate::allows('manage.posts')
                ? User::all()
                : User::whereId(auth()->id())->get()
            ;
        }

        protected function getCommonData() {
            return [
                'post' => $this->post,
                'authors' => $this->authors,
                'temporal_names' => TemporalName::all(),
                'categories' => Category::orderBy('name')->get(),
            ];
        }
    }
