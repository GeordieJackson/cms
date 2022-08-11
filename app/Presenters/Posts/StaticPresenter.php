<?php

    namespace App\Presenters\Posts;

    use Facades\App\Services\Breadcrumb;

    class StaticPresenter extends BasePostPresenter
    {
        public function toResponse($request)
        {
            $this->prepare($request);

            return view('front.pages.static.show')
                ->with([
                    'meta' => (object)$this->meta,
                    'post' => (object)$this->post,
                    'breadcrumb' => Breadcrumb::fromString($this->post->slug)
                ]);
        }
    }
