<?php
    
    namespace App\Presenters\Posts;
    
    use App\Models\Posts\Post;
    use Illuminate\Contracts\Support\Responsable;
    
    use function publicationDate;
    
    abstract class BasePostPresenter implements Responsable
    {
        protected $author;
        protected $meta;
        protected $post;
        protected $publication_date;
        protected $breadcrumb;
        
        /**
         * BasePostPresenter constructor.
         *
         * @param  \App\Models\Posts\Post  $post
         */
        public function __construct(Post $post)
        {
            $this->post = $post;
        }
        
        abstract public function toResponse($request);
        
        /**
         * @param  \Illuminate\Http\Request  $request
         */
        public function prepare($request)
        {
            $this->extractMetaFrom($this->post);
        }
        
        /**
         * @param  \App\Models\Posts\Post  $post
         */
        protected function extractMetaFrom(Post $post)
        {
            $this->meta = [
                'title' => $post->meta_title,
                'description' => $post->meta_description,
                'keywords' => $post->meta_keywords,
            ];
        }
        
        protected function setAuthor()
        {
            $this->author = new \stdClass();
            $this->author->name = $this->post->owner['forename']." ".$this->post->owner['surname'];
            $this->author->slug = $this->post->owner['slug'];
        }
        
        protected function setPublicationDate()
        {
            $this->publication_date = publicationDate($this->post->publication_date);
        }
    }