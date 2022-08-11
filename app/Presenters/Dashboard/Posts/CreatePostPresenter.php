<?php

    namespace App\Presenters\Dashboard\Posts;

    use App\Models\Posts\Post;

    use function view;
    use function auth;

    class CreatePostPresenter extends BasePostPresenter
    {
        public function __construct(Post $post)
        {
            parent::__construct($post);

            $this->post->owner_id = auth()->id(); // Set current user as default
        }

        public function toResponse($request)
        {
            return view('dashboard.posts.create')
                ->with([
                        'temporal_id' => null,
                        'tags' => null,
                    ] + $this->getCommonData());
        }
    }
