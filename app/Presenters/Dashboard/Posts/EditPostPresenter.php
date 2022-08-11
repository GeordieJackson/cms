<?php

    namespace App\Presenters\Dashboard\Posts;

    use App\Models\Posts\Post;

    use function app;
    use function view;

    class EditPostPresenter extends BasePostPresenter
    {
        protected $post;
        protected $post_type;
        protected $tags;
        protected $temporal_id;
        protected $authors; // For author selection

        public function __construct(Post $post)
        {
            parent::__construct($post);

            $this->temporal_id = $post->temporal_id;
            $this->post_type = $post->type;
            $this->tags = $this->tagsToString();
        }

        public function toResponse($request)
        {
            return view('dashboard.posts.edit')->with([
                    'temporal_id' => $this->temporal_id,
                    'tags' => $this->tags,
                ] + $this->getCommonData());
        }

        protected function tagsToString()
        {
            return $this->post->tags->pluck('name')->implode(", ");
        }
    }
