<?php

    namespace App\Presenters\Posts;

    use function abort;

    class NullPostPresenter extends BasePostPresenter
    {
        public function toResponse($request)
        {
            abort(404, 'An article was matched but not returned');
        }
    }
